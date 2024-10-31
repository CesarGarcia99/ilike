<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function save(Request $request){
        //validacion 
        $validate = $this->validate($request,[
            'image_id'=>['integer','required'],
            'content'=>['required','string']
        ]);
        
        //recoger datos 
        $user =\Auth::user();
        $image_id=$request->input('image_id');
        $content=$request->input('content');
        
        //asignar valores al nuevo objeto
        $comment= new Comment();
        $comment->user_id=$user->id;
        $comment->image_id=$image_id;
        $comment->content=$content;
        
        $comment->save();
        
        return redirect()->route('publi.detail',['id'=>$image_id]);
    }
    
    public function delete($id){
        //datos del usuario identificado
        $user=\Auth::user();
        
        //conseguir objeto del comentario
        $comment = Comment::find($id);
        
        //comprobar si es dueño de la publicación o el usuario
        if($user && ($comment->user_id == $user->id or $comment->image->user_id == $user->id)){
            $comment->delete();
            return redirect()->route('publi.detail',['id'=>$comment->image->id])
                    ->with(['message'=>'Comentario eliminado!']);
        }else{
            return redirect()->route('publi.detail',['id'=>$comment->image->id])
                    ->with(['message'=>'Comentario no eliminado!']);
        }
    }
}
