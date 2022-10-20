<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shopcart;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class OrderController extends Controller
{
   
    public function index()
    {
        $datalist = Order::where('user_id',Auth::id())->get();
        return view('home.user_order', ['datalist' => $datalist]);

    }

   
    public function create(Request $request)
    {
        $total =  $request->input('total');
        return view('home.user_order_add', ['total'=> $total]);
    }

   
    public function store(Request $request)
    {
        # Get credit card information send to bank webservice if everything is ok next.
        // Bu bilgileri kaydetmeden önce normmalde kredi kartı bilgilerini alıp bankadan okey aldığımızı varsayıyoruz.
        $data = new Order;
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->total = $request->input('total');
        $data->user_id = Auth::id();
        $data->IP = $_SERVER['REMOTE_ADDR'];
        $data->save();

        $datalist = Shopcart::where('user_id',Auth::id())->get();
        foreach ($datalist as $rs)
        {
            $data2 = new Orderitem;
            $data2->user_id = Auth::id();
            $data2->product_id = $rs->product_id;
            $data2->order_id =  $data->id;// son kaydı alıyo id
            $data2->price =  $rs->product->price;
            $data2->quantity =  $rs->quantity;
            $data2->amount =  $rs->quantity * $rs->product->price;
            $data2->save();

        }
        $data3 = Shopcart::where('user_id', Auth::id());// sipariş verilince sepetten userid si bu olan ürünleri sil
        $data3->delete();

        return redirect()->route('user_orders')->with('success','Product Order Succesfully');
    }

   
    public function show(Order $order, $id)
    {
        $datalist = Orderitem::where('user_id',Auth::id())->where('order_id', $id)->get();
        return view('home.user_order_item', ['datalist' => $datalist]);
    }

  
    public function edit(Order $order)
    {
        //
    }

   
    public function update(Request $request, Order $order)
    {
        //
    }

   
    public function destroy(Order $order)
    {
        //
    }
}
