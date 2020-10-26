<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Channel;
use Auth;

class ForumsController extends Controller
{
    public function index(){

        $discussions = Discussion::where('state',1)->orderBy('created_at','desc')->paginate(3);
        return view('forum',['discussions'=>$discussions]);
    }

    public function channel($slug){
        $channel = Channel::where('slug',$slug)->first();
        return view('channel')->with('discussions',$channel->discussions()->orderBy('created_at', 'desc')->paginate(3));
    }

    public function inbox()
    {
        
        $discussions = Discussion::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(3);
        return view('myDiscussions', ['discussions' => $discussions]);
    }
}
