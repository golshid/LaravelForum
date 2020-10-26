<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class channel extends Model
{
    protected $fillable = ['title','slug'];

    public function discussions(){
        return $this->hasMany('App\Discussion');
    }
}