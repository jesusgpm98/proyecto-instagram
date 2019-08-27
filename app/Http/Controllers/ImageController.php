<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function create(){
    return view('image.create');
  }

  public function save(Request $request){
    //validacion
    $validate = $this->validate($request, [
      'description' => ['required'],
      'image_path' => ['required','image']
    ]);

    //recoger los datos
    $image_path = $request->file('image_path');
    $description = $request->input('description');

    //asignar valores a los objetos
    $user = \Auth::user();
    $image = new Image();
    $image->user_id = $user->id;
    $image->description = $description;

    //subir fichero
    if($image_path){
      $imagen = date('Y-m-d').'_'.$image_path->getClientOriginalName();
      Storage::disk('images')->put($imagen, File::get($image_path));
      $image->image_path = $imagen;
    }

    //guardar datos en bd
    $image->save();

    return redirect()->route('home')
    ->with('message_image', 'Saved photo');
  }

  public function getImage($filename){
    $file = Storage::disk('images')->get($filename);
    return new response($file,200);
  }

  public function detail($id){
    $image = Image::findOrFail($id);
    return view('image.detail', compact('image'));
  }

  public function delete($id){
    $user = \Auth::user();
    $image = Image::findOrFail($id);
    $comments = Comment::where('image_id',$id)->get();
    $likes = Like::where('image_id',$id)->get();

    //eliminar comentarios
    if($user && $image->user->id == $user->id){
      if($comments && count($comments) >= 1){
        foreach ($comments as $comment) {
          $comment->delete();
        }
      }

      //eliminar likes
      if($likes && count($likes) >= 1){
        foreach ($likes as $like) {
          $like->delete();
        }
      }
      //eliminar fichero de la imagen
      Storage::disk('images')->delete($image->image_path);
      //eliminar registro de la imagen
      $image->delete();
      $message = array('message_delete_photo' => 'image delete');
    }else{
      $message = array('message_delete_photo' => 'no delete');
    }

    return redirect()->route('home')
                     ->with($message);
  }

  public function edit($id){
    $user = \Auth::user();
    $image = Image::findOrFail($id);

    if($user && $image && $image->user->id == $user->id){
      return view('image.edit', compact('image'));
    }else{
      return redirect()->route('home');
    }
  }

  public function update(Request $request){
    //validacion
    $validate = $this->validate($request, [
      'description' => ['required'],
      'image_path' => ['image']
    ]);

    $image_id = $request->input('image_id');
    $image_path = $request->file('image_path');
    $description = $request->input('description');

    //conseguir objeto imagen
    $image = Image::findOrFail($image_id);
    $image->description = $description;

    //subir fichero
    if($image_path){
      $imagen = date('Y-m-d').'_'.$image_path->getClientOriginalName();
      Storage::disk('images')->put($imagen, File::get($image_path));
      $image->image_path = $imagen;
    }

    $image->update();

    return redirect()->route('image.detail', ['id' => $image_id])
                     ->with('message_update_photo', 'updated correctly');
  }
}
