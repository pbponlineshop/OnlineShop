<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!\Session::get('customer')) {
            return view('template.login');
        } else {
            $id_produk = $request->input('id_produk');
            $harga_produk = $request->input('harga_produk');
            $id_cust = \Session::get('customer.0')['id_cust'];
            $transaksi = \App\transaksi::where('id_cust', $id_cust)->where('status', 'pending')->get();
            //liat dah ada transaksi aktif ato belom
            if ($transaksi->count() == 0) {
                \DB::insert('insert into transaksis (ongkir, tgl_trans, id_cust, status) values (?, ?, ?, ?)', [0, NOW(), $id_cust, 'pending']);
            }
            $id_trans = \DB::table('transaksis')->select('id_trans')->where('id_cust', $id_cust)->where('status', 'pending')->first()->id_trans;
            $total_barang = \App\transaksiDetail::where('id_produk', $id_produk)->where('id_trans', $id_trans)->get();


    //        liat barang udah ada d cart ato belom
            if ($total_barang->count() == 0) {
                \DB::insert('insert into transaksi_details (harga_satuan, jumlah_barang, id_trans, id_produk) '
                    . 'values (?, ?, ?, ?)', [$harga_produk, 1, $id_trans, $id_produk]);
            } else {
                $total_barang = \DB::table('transaksi_details')->select('jumlah_barang')->where('id_produk', $id_produk)->where('id_trans', $id_trans)->first()->jumlah_barang;
                $total_barang += 1;
                $id_transdetail = \DB::table('transaksi_details')->select('id_transdetail')->where('id_produk', $id_produk)->where('id_trans', $id_trans)->first()->id_transdetail;
                \DB::update('update transaksi_details set jumlah_barang =  ? where id_transdetail = ?', [$total_barang, $id_transdetail]);
            }

            $carts = \DB::table('transaksi_details')
                    ->join('produks', 'transaksi_details.id_produk', '=', 'produks.id_produk')->select('produks.*', 'transaksi_details.*')->where('id_trans', $id_trans)->get();
            return view('template.cart', ['carts' => $carts]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(!\Session::get('customer')) {
            return view('template.login');
        } else {
            $id_cust = \Session::get('customer.0')['id_cust'];
            $transaksi = \App\transaksi::where('id_cust', $id_cust)->where('status', 'pending')->get();
            //liat dah ada transaksi aktif ato belom
            if ($transaksi->count() == 0) {
                $id_trans = \DB::table('transaksis')->select('id_trans')->where('id_cust', $id_cust)->where('status', 'pending')->first();
            } else {
                $id_trans = \DB::table('transaksis')->select('id_trans')->where('id_cust', $id_cust)->where('status', 'pending')->first()->id_trans;
            }
            $transaksi_details = \App\transaksiDetail::where('id_trans', $id_trans)->get();

            $carts = \DB::table('transaksi_details')
                    ->join('produks', 'transaksi_details.id_produk', '=', 'produks.id_produk')->select('produks.*', 'transaksi_details.*')->where('id_trans', $id_trans)->get();
            return view('template.cart', ['carts' => $carts]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::delete('delete from transaksi_details where id_transdetail = ?', [$id]);
        
        $id_cust = \Session::get('customer.0')->id_cust;
        $id_trans = \DB::table('transaksis')->select('id_trans')->where ('id_cust', $id_cust)->where('status', 'pending')->first()->id_trans;
        $transaksi_details = \App\transaksiDetail::where('id_trans', $id_trans)->get();
        
        $carts = \DB::table('transaksi_details')
                ->join('produks', 'transaksi_details.id_produk', '=', 'produks.id_produk')->select('produks.*', 'transaksi_details.*')->where('id_trans', $id_trans)->get();
        return view('template.cart', ['carts' => $carts]);
    }
}
