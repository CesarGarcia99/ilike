<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Image;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function config() {
        return view('user.config');
    }

    public function update(Request $request) {
        //conseguir al usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        //validación del formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', Rule::unique('users', 'nick')->ignore($id, 'id')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id, 'id')]
        ]);

        //guardar los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //actualizar datos al objeto usuario (usar el modelo usuario)
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            //poner nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            //guardar en la carpeta storage(storage/app/users)
            \Storage::disk('users')->put($image_path_name, File::get($image_path));

            //guardar el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }
        //guardar los cambios en la bd
        $user->update();
        return redirect()->route('user.config')
                        ->with(['message' => 'Usuario actualizado!']);
    }
    public function getAvatar($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }
    public function profile($id){
        $user=User::find($id);
        return view('user.profile',['user'=>$user]);
    }
}
