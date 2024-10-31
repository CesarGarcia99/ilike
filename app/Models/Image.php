<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    use HasFactory;

    protected $table = 'images';
    //uno a muchos
    public function Comment(){
        return $this->hasMany('App\Models\Comment');
    }
    //uno a muchos
    public function Like(){
        return $this->hasMany('App\Models\Like');
    }
    //muchos a uno
    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
