<?php

namespace App\Http\Controllers\home;

use App\wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class wishlistController extends Controller
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

    public function notification()
    {
        return '<script type="text/javascript">alert("Is already in wishlist!");</script>';
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
        //
        if(!\Session::get('customer')) {
            return view('template.login');
        } else {
            $id_produk = $request->input('id_produk');
            $id_cust = \Session::get('customer.0')['id_cust'];

            $total_barang = \App\wishlist::where('id_produk', $id_produk)->where('id_cust', $id_cust)->get();

            //cek barang sudah ada diwishlist atau belum
            if ($total_barang->count() == 0) {
                \DB::insert('insert into wishlists (id_cust, id_produk) values (?, ?)', [$id_cust, $id_produk]);
                return \Redirect::back();
            } else {
                return \Redirect::back()->with('alert', 'is already in wishlist');
            }
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
        //
        $id_cust = \Session::get('customer.0')->id_cust;
        $wishlists = \DB::table('produks')
                        ->join('wishlists', 'wishlists.id_produk', '=', 'produks.id_produk')
                        ->select('produks.id_produk', 'produks.nama_produk', 'produks.desc_produk', 'produks.harga_produk', 'produks.image', 'wishlists.id_wishlist')
                        ->where('id_cust',$id_cust)
                        ->get();
        
        return view('template.wishlist', ['wishlists' => $wishlists]);
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
        \DB::delete('delete from wishlists where id_wishlist = ?', [$id]);
        
        return $this->show();
    }
}
