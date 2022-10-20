<?php

namespace App\Http\Controllers;

use App\Models\Shopcart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopcartController extends Controller
{
    public static function countshopcart()
    {
        return Shopcart::where('user_id',Auth::id())->count();
    }
    
    public function index()
    {
        $datalist = Shopcart::where('user_id',Auth::id())->get();
        return view('home.user_shopcart', ['datalist' => $datalist]);
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request, $id)
    {
        $data = Shopcart::where('product_id', $id)->where('user_id', Auth::id())->first();// ürünün id si eklenmeye çalışan ürününkine eşitse ve user_id  authid ise yani o userın sa
        if ($data) // o ürün daha önceden eklenmişse
        {
            $data->quantity = $data->quantity + $request->input('quantity'); // adet sayısına ekleme yapıcak
        }
        else
        {
            $data = new Shopcart;
            $data->product_id = $id;
            $data->user_id = Auth::id();
            $data->quantity = $request->input('quantity'); 
        }

        $data->save();
        return redirect()->back()->with('success','Product Added to Shopcart');

    }

 
    public function show(Shopcart $shopcart)
    {
        //
    }

  
    public function edit(Shopcart $shopcart)
    {
        //
    }

  
    public function update(Request $request, Shopcart $shopcart, $id)
    {
        $data = Shopcart::find($id);
        $data->quantity = $request->input('quantity'); 
        $data->save();
        return redirect()->back()->with('success','Product Update to Shopcart');

    }

  
    public function destroy(Shopcart $shopcart, $id)
    {
        $data = Shopcart::find($id);
        $data->delete();

        return redirect()->back()->with('success', 'Product deleted from Shopcart');
    }
}
