<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function save(Request $request){
    //validacion
    $validate = $this->validate($request,[
      'image_id' => ['integer', 'required'],
      'content' => ['string', 'required']
    ]);

    //recoger datos
    $user = \Auth::user();
    $image_id = $request->input('image_id');
    $content = $request->input('content');

    //asignar valor a nuevo objeto a guardar
    $comment = new Comment();
    $comment->user_id = $user->id;
    $comment->image_id = $image_id;
    $comment->content = $content;
    $comment->save();

    return redirect()->route('image.detail', ['id' => $image_id])
                     ->with('message_comment', 'posted message');
  }

  public function delete($id){
    //conseguir datos del usuario identificado
    $user = \Auth::user();

    //conseguir objeto del Comentario
    $comment = Comment::findOrFail($id);

    //comprobar si soy el dueño del comentario o de la publicacion
    if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
      $comment->delete();
      return redirect()->route('image.detail', ['id' => $comment->image->id])
                       ->with('message_delete', 'Message delete');
    }else{
      return redirect()->route('image.detail', ['id' => $comment->image->id])
                       ->with('message_delete', 'Message no delete');
    }
  }
}
