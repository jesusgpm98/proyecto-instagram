<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //relacion one to many / uno a muchos
    public function comments(){
      return $this->hasMany(Comment::class)->orderBy('id','DESC');
    }

    //relacion one to many / uno a muchos
    public function likes(){
      return $this->hasMany(Like::class);
    }

    //relacion de many to one
    public function user(){
      return $this->belongsTo(User::class);
    }
}
