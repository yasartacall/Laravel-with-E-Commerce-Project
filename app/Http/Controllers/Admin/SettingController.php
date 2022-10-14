<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::first();// settingin ilk kaydını getir
        if ($data===null) // boş ise oluşturucaz  // 1 kere çalıştıktan sonra buraya girmeyecek
        {
            $data = new Setting;
            $data->title = 'Project Title';
            $data->save();
            $data = Setting::first();// içerisi dolduktan sonra tekrar sorgu yapıyorum
        }

        return view('admin.setting_edit',['data' => $data]);
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Setting $setting)
    {
        //
    }

    
    public function edit(Setting $setting)
    {
        //
    }

   
    public function update(Request $request, Setting $setting)
    {
        $id = $request->input('id');

        $data = Setting::find($id);
        $data->title = $request->input('title');
        $data->keywords = $request->input('keywords');
        $data->description = $request->input('description');
        $data->company = $request->input('company');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');;
        $data->fax = $request->input('fax');
        $data->email = $request->input('email');
        $data->smtpserver = $request->input('smtpserver');
        $data->smtpemail = (int) $request->input('smtpemail');
        $data->smtppassword = $request->input('smtppassword');
        $data->smtpport = $request->input('smtpport');
        $data->facebook = $request->input('facebook');
        $data->instagram = $request->input('instagram');
        $data->twitter = $request->input('twitter');
        $data->youtube = $request->input('youtube');
        $data->aboutus = $request->input('aboutus');
        $data->contact = $request->input('contact');
        $data->references = $request->input('references');
        $data->status = $request->input('status');
        $data->save();
        return redirect()->route('admin_setting');
    }

  
    public function destroy(Setting $setting)
    {
        //
    }
}
