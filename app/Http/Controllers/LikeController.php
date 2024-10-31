<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Like;

class LikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function like($image_id){
        //recoger usuario
        $user=\Auth::user();
        
        //condición de existencia
        $isset_like=Like::Where('user_id',$user->id)
                ->where('image_id',$image_id)
                ->count();
        
        if($isset_like == 0){
            $like = new Like();
            $like->user_id=$user->id;
            $like->image_id = (int)$image_id;
            
            $like->save();
            return Response()->json(['like'=>$like]);
        }

    }
    
    public function dislike($image_id){
        //recoger usuario
        $user=\Auth::user();
        
        //condición
        $like=Like::Where('user_id',$user->id)
                ->where('image_id',$image_id)
                ->first();
        
        if($like){
            //eliminar like
            $like->delete();
            return Response()->json(['like',$like]);
        }
    }
}
