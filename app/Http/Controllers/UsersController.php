<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Session;

class UsersController extends Controller
{
    public function number()
    {
        
        return view('adminControlPanel')->with('users', User::all());
    }

    public function promote($id){
        $user = User::find($id);
        $user->admin = 1;
        $user -> save();
        return redirect()->back();
    }

    public function demote($id)
    {
        $user = User::find($id);
        $user->admin = 0;
        $user->save();
        return redirect()->back();
    }


    public function block($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return redirect()->back();
    }

    public function unblock($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return redirect()->back();
    }
}
