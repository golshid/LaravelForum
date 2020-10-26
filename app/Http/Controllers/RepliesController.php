<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Reply;
use App\Like;
use App\Dislike;
use App\Discussion;
use Auth;

class RepliesController extends Controller
{
    public function like($id){
        $reply=Reply::find($id);

        Like::create([
            'reply_id'=> $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success','You liked the reply.');
        return redirect()->back();
    }

    public function unlike($id){

        $like = Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();
        Session::flash('success', 'You unliked the reply.');
        return redirect()->back();
    }

    public function dislike($id)
    {
        Dislike::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'You disliked the reply.');
        return redirect()->back();
    }

    public function undislike($id)
    {

        $dislike = Dislike::where('reply_id', $id)->where('user_id', Auth::id())->first();
        $dislike->delete();
        Session::flash('success', 'You undisliked the reply.');
        return redirect()->back();
    }


    public function edit($id)
    {
        return view('discussions.editReply', ['reply' => Reply::where('id', $id)->first()]);
    }
    

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        
        $r = Reply::find($id);
        $r->content = request()->content;
        $r->save();
        Session::flash('success', 'Reply successfully updated');
        $rout = $r-> discussion_id;
        $di = Discussion::find($rout);
        return redirect()->route('discussion', ['slug' => $di->slug]);
    }

    public function delete($id)
    {
        
        $reply = Reply::where('id', $id)->first();
        $reply->delete();
        Session::flash('success', 'You deleted the reply.');
        return redirect()->back();
    }
   

    
    
}
