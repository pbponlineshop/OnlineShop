<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class checkoutController extends Controller
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
            $id_cust = \Session::get('customer.0')['id_cust'];
            $transaksi = \App\transaksi::where('id_cust', $id_cust)->where('status', 'pending')->get();
            
            //liat dah ada transaksi aktif ato belom
            if ($transaksi->count() == 0) {
                $id_trans = \DB::table('transaksis')->select('id_trans')->where('id_cust', $id_cust)->where('status', 'pending')->first();
            } else {
                $id_trans = \DB::table('transaksis')->select('id_trans')->where('id_cust', $id_cust)->where('status', 'pending')->first()->id_trans;
            }
            
            //check ada produk yang dibeli ga, kalo gaada gausa update table
            $transdetails = \App\transaksiDetail::where('id_trans', $id_trans)->get();
            if ($transdetails->count() == 0) {
                
            } else {
                //update stock produk
                foreach ($transdetails as $transdetail) {
                    $new_stock = (\DB::table('produks')->select('stok')->where('id_produk', $transdetail->id_produk)->first()->stok) - ($transdetail->jumlah_barang);
                    \DB::update('update produks set stok = ? where id_produk = ?', [$new_stock, $transdetail->id_produk]);
                }
                
                \DB::update('update transaksis set tgl_trans = ?, status =  ? where id_trans = ?', [NOW(), 'selesai', $id_trans]);
                
                $id_trans = \DB::table('transaksis')->select('id_trans')->where('id_cust', $id_cust)->where('status', 'pending')->first();
            }
            
            $carts = \DB::table('transaksi_details')
                        ->join('produks', 'transaksi_details.id_produk', '=', 'produks.id_produk')->select('produks.*', 'transaksi_details.*')->where('id_trans', $id_trans)->get();
            return view('template.checkout', ['carts' => $carts]);
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
            $carts = \DB::table('transaksi_details')
                    ->join('produks', 'transaksi_details.id_produk', '=', 'produks.id_produk')->select('produks.*', 'transaksi_details.*')->where('id_trans', $id_trans)->get();
            
            return view('template.checkout', ['carts' => $carts]);
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
        //
    }
}
