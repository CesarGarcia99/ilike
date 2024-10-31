<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    use HasFactory;

    protected $table = 'likes';
    //muchos a uno
    public function Image(){
        return $this->belongsTo('App\Models\Image','image_id');
    }
    //muchos a uno
    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
