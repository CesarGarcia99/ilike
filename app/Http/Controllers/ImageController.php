<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;

class ImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function postear(){
        return view('image.publi');
    }
    
    public function create(Request $request){
        //validacion
        $validate = $this->validate($request,[
            'description'=>['required'],
            'image_path'=>['required','image']
        ]);
        //recoger los valores
        $image_path=$request->file('image_path');
        $description =$request->input('description');
        
        //asignar al objeto
        $user=\Auth::user();
        $image= new Image();
        $image->user_id=$user->id;
        $image->description=$description;
        
        //subir imagen
        if($image_path){
            $image_path_name= time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            $image->image_path=$image_path_name;
        }
        $image->save();
        return redirect()->route('home');
    }
    
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file,200);
    }
    
    public function detail($id){
        $image=Image::find($id);
        return view('image.detail',['image'=>$image]);
    }
    
    public function delete($id){
        $user=\Auth::user();
        $image= Image::find($id);
        $comments=Comment::where('image_id',$id)->get();
        $likes=Like::where('image_id',$id)->get();
        
        if($user && $image && $image->user->id== $user->id){
            if($comments && count($comments)>=1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            
            if($likes && count($likes)>=1){
                foreach($likes as $like){
                    $like->delete();
                }
            }
            
            Storage::disk('images')->delete($image->image_path);
            
            $image->delete();
        }
        return redirect()->route('home');
    }
}
