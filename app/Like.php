<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $table = 'likes';

  //relacion de many to one
  public function user(){
    return $this->belongsTo(User::class);
  }

  //relacion de many to one
  public function image(){
    return $this->belongsTo(Image::class);
  }
}
