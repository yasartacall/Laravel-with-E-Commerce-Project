<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $datalist = Message::all();
        return view('admin.messages', ['datalist' => $datalist]);
    }

    
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

 
    public function show(Message $message)
    {
        //
    }

 
    public function edit(Message $message, $id)
    {
        $data = Message::find($id);
        $data->status = 'Read';
        $data->save();

        return view('admin.messages_edit',['data' => $data]);
    }

 
    public function update(Request $request, Message $message, $id)
    {
        $data = Message::find($id);
        $data->note = $request->input('note');
        $data->save();
        return back()->with('success', 'Message Updated');
    }

  
    public function destroy(Message $message, $id)
    {
        $data = Message::find($id);
        $data->delete();

        return redirect()->route('admin_message')->with('info', 'Messages deleted');
    }
}
