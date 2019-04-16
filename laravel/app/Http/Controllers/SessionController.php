<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function accessSessionData(Request $request) {
      if($request->session()->has('my_name'))
         echo $request->session()->get('my_name');
      else
         echo 'No data in the session';
   }
   public function storeSessionData(Request $request) {
        $nama_cust = $request->input('nama_cust');
        $password = $request->input('password');
        $customer = \App\Customer::where('nama_cust', $nama_cust)->where('password', $password)->get();
        
        //kalo nama & pass salah
        if ($customer->count() == 0) {
            return redirect('login')->with('alert','Password atau Email, Salah !');
        } else {
            $produks = \App\Produk::all();
            \Session::put('customer', $customer);
            return view('template.index', ['produks' => $produks]);
        }
        
        echo "Data has been added to session";
   }
   public function deleteSessionData(Request $request) {
      $request->session()->forget('customer');
      return view('template.login');
   }
}
