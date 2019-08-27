<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;

class UserController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index($search = null){
    if (!empty($search)) {
      $users = User::where('username','LIKE', '%'.$search.'%')
                   ->orWhere('name','LIKE', '%'.$search.'%')
                   ->orderBy('id', 'desc')
                   ->paginate(5);
    }else{
      $users = User::orderBy('id', 'desc')->paginate(5);
    }
      return view('user.index', compact('users'));
  }

    public function config(){
      return view('user.config');
    }

    public function update(Request $request){
      //comseguir usuario identificado
      $user = \Auth::user();
      $id = $user->id;

      //validacion del formulario
      $validate = $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'lastName' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$id],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
      ]);

      //recoger datos del formulario
      $name = $request->input('name');
      $lastname = $request->input('lastName');
      $username = $request->input('username');
      $email = $request->input('email');

      //asignar nuevos valores al objeto de usuario
      $user->name = $name;
      $user->lastName = $lastname;
      $user->username = $username;
      $user->email = $email;

      //subir imagen
      $image_path = $request->file('image_path');
      if($image_path){
        //poner nombre unico
        $imagen = time().$image_path->getClientOriginalName();
        //guardarla en la carpeta storage (storage/app/user)
        Storage::disk('users')->put($imagen, File::get($image_path));
        //seteo el nombre de la imagen en el objeto
        $user->image = $imagen;
      }

      //actualizar registro
      $user->update();

      return redirect()->route('user.config')
                       ->with('message_update', 'Updated account!');
    }

    public function getImage($filename){
      $file = Storage::disk('users')->get($filename);
      return new response($file,200);
    }

    public function updatePassword(Request $request){
      $user = \Auth::user();

      $validate = $this->validate($request, [
        'password' => ['required', 'string', 'min:6', 'confirmed'],
      ]);

      $password = $request->input('password');

      $user->password = Hash::make($password);
      $user->update();

      return redirect()->route('user.config')
                       ->with('message_updatePassword', 'Password updated!');
    }

    public function profile($id){
      $user = User::findOrFail($id);
      return view('user.profile', compact('user'));
    }
}
