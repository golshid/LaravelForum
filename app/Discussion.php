<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Auth;

class Discussion extends Model
{
    protected $fillable = ['title','content','user_id','channel_id','state','open','slug'];

    public function channel(){
        return $this -> belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function dislikes()
    {
        return $this->hasMany('App\Dislike');
    }


    public function dis_is_liked_by_auth_user()
    {
        $id = Auth::id();
        $likers = array();
        foreach ($this->likes as $like) :
            array_push($likers, $like->user_id);
        endforeach;

        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }

    public function dis_is_disliked_by_auth_user()
    {
        $id = Auth::id();
        $dislikers = array();
        foreach ($this->dislikes as $dislike) :
            array_push($dislikers, $dislike->user_id);
        endforeach;

        if (in_array($id, $dislikers)) {
            return true;
        } else {
            return false;
        }
    }

}
