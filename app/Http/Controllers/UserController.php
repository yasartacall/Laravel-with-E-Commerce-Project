<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
   
    public function index()
    {
        return view('home.user_profile');
    }

    public function myreviews()
    {
        $datalist = Review::where('user_id','=',Auth::user()->id)->get();// user id si o an login olanın idsine eşit olan reviewler gelcek.
        return view('home.user_reviews', ['datalist'=>$datalist]);
    }

    public function destroymyreview(Review $review, $id)
    {
        $data = Review::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Review Deleted');
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(User $user)
    {
        //
    }

    
    public function edit(User $user)
    {
        //
    }

    
    public function update(Request $request, User $user)
    {
        //
    }

  
    public function destroy(User $user)
    {
        //
    }
}
