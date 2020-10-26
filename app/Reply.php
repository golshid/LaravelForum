<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content','user_id','discussion_id'];

    public function discussion(){
        return $this-> belongsTo('App\Discussion');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function dislikes()
    {
        return $this->hasMany('App\Dislike');
    }

    public function is_liked_by_auth_user(){
        $id = Auth::id();
        $likers = array();
        foreach ($this->likes as $like):
            array_push($likers,$like->user_id);
        endforeach;

        if (in_array($id,$likers)) {
            return true;
        }
        else {
            return false;
        }   
    }

    public function is_disliked_by_auth_user()
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
