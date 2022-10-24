<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
   
    public function index()
    {
        $datalist = Order::all();
        return view('admin.orders', ['datalist' => $datalist]);
    }

    public function list($status)
    {
        $datalist = Order::where('status', $status)->get();
        return view('admin.orders', ['datalist' => $datalist]);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Order $order, $id)
    {
        $data = Order::find($id);
        $datalist = Orderitem::where('order_id', $id)->get();
        return view('admin.order_items', ['datalist' => $datalist, 'data' => $data]);
    }

    
    public function edit(Order $order)
    {
        //
    }

   
    public function update(Request $request, Order $order, $id)
    {
        $data = Order::find($id);
        $data->status = $request->input('status');
        $data->note = $request->input('note');
        $data->save();
        return redirect()->back()->with('success', 'Order Updated');

    }

    public function itemupdate(Request $request, Order $order, $id)
    {
        $data = Orderitem::find($id);
        $data->status = $request->input('status');
        $data->note = $request->input('note');
        $data->save();
        return redirect()->back()->with('success', 'Order Item Updated');


    }

    
    public function destroy(Order $order)
    {
        //
    }
}
