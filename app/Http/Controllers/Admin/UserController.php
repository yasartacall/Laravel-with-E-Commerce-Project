<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    
    public function index()
    {
        $datalist = User::all();
        return view('admin.user', ['datalist' => $datalist]);
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(User $user, $id)
    {
        $data = User::find($id);  
        $datalist = Role::all()->sortBy('name');
        return view('admin.user_show',['data' => $data, 'datalist' => $datalist]);    }

   
    public function edit(User $user, $id)
    {
        $data = User::find($id);
        return view('admin.user_edit',['data' => $data]);
    }

   
    public function update(Request $request, User $user, $id)
    {
        $data = User::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->address = $request->input('address');
       
        if ($request->file('image')!=null) // boş değilse yani bişey seçildiyse dikkate alıcak
        {
            $data->profile_photo_path = Storage::putFile('profile-photos', $request->file('image'));
        }
        $data->save();
        return redirect()->route('admin_users')->with('success', 'User Information Updated');
    }

    public function user_roles(User $user, $id)
    {
        $data = User::find($id);
        $datalist = Role::all()->sortBy('name');
        return view('admin.user_roles',['data' => $data, 'datalist' => $datalist]);

    }

    public function user_role_store(Request $request, User $user, $id)
    {
        
        $user = User::find($id);
        $roleid = $request->input('roleid');
        $user->roles()->attach($roleid); #Many to Many ilişkisine veri ekliyor. mesela 1 id li userın rolüne bakıyo 3 role id li rol var yeni ekleme yapıyo hem 3 hem 5 rol id li rolleri olmuş oluyo
        return redirect()->back()->with('success','Role added to user');
    }

    public function user_role_delete(Request $request, User $user, $userid, $roleid)
    {
        $user = User::find($userid);
        $user->roles()->detach($roleid); #Many to Many ilişkisinde veri siler.
        return redirect()->back()->with('success','Role deleted from user');
    }

    
    public function destroy(User $user)
    {
        //
    }
}
