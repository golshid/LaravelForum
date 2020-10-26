<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use Auth;
use Session;
use App\Reply;
use App\Like;
use App\Dislike;


class DiscussionsController extends Controller
{
    
    public function create(){
        return view('discuss');
    }

    public function store()
    {
        $r = request();
        $this->validate($r,[
            'channel_id'=>'required',
            'title' => 'required', 
            'content'=>'required'
        ]);

        if (Auth::user()->admin > 0) {
            $x = 1;
        }
        else {
            $x =0;
        }
        $discussion = Discussion::create([
            'title'=> $r -> title,
            'content'=> $r -> content,
            'channel_id' => $r->channel_id,
            'user_id' => Auth::id(),
            'state'=>$x,
            'slug'=>str_slug($r->title)

        ]);
        Session::flash('success','Discussion successfully created.');
        if (Auth::user()->admin>0) {
            return redirect()->route('discussion', ['slug' => $discussion->slug]);
        }
        else{
        return view('pleasewait');}
    }

    public function show($slug){
        $discussion = Discussion::where('slug',$slug)->first();
        return view('discussions.show')->with('d',$discussion);
    }

    public function reply($id){
        $d = Discussion::find($id);
        $reply = Reply::create([
            'user_id'=> Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        Session::flash('success','Replied to Discussion.');
        return redirect()->back();
    }


    function bestReply($slug)
    {
        
        $d = Discussion::where('slug', $slug)->first();
        $array = [];
        
        foreach($d->replies as $r){
           // $array = array_add($array1,$r->content, $r->likes->count());
            $array[$r->content]=$r->likes->count();  
        }
        arsort($array);
        return view('discussions.show', compact('array','d'));
    }


    public function edit($slug)
    {
        return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);
        $d->content = request()->content;
        $d->save();
        Session::flash('success', 'Discussion successfully updated');
        return redirect()->route('discussion', ['slug' => $d->slug]);
    }

    public function viewAdmin($id){
        $discussion = Discussion::find($id);
        return view('adminViewDiscussion')->with('d', $discussion);
    
    }

    public function discussionApproval($id)
    {
        $discussion = Discussion::find($id);
        $discussion -> state = 1;
        $discussion -> save();
        return redirect()->back();
    }

    public function closeDiscussion($id)
    {
        $discussion = Discussion::find($id);
        $discussion->open = 0;
        $discussion->save();
        return redirect()->back();
    }

    public function openDiscussion($id)
    {
        $discussion = Discussion::find($id);
        $discussion->open = 1;
        $discussion->save();
        return redirect()->back();
    }

    public function like($id)
    {
        // $reply = Discussion::find($id);

        Like::create([
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'You liked the discussion.');
        return redirect()->back();
    }

    public function unlike($id)
    {

        $like = Like::where('discussion_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        Session::flash('success', 'You unliked the discussion.');
        return redirect()->back();
    }

    public function dislike($id)
    {
        Dislike::create([
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'You disliked the discussion.');
        return redirect()->back();
    }

    public function undislike($id)
    {

        $dislike = Dislike::where('discussion_id', $id)->where('user_id', Auth::id())->first();
        $dislike->delete();
        Session::flash('success', 'You undisliked the discussion.');
        return redirect()->back();
    }


}
