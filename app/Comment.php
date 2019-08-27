<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //relacion de many to one
    public function user(){
      return $this->belongsTo(User::class);
    }

    //relacion de many to one
    public function image(){
      return $this->belongsTo(Image::class);
    }
}
