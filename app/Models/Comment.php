<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['body'];

    //relacion inversa uno a muchos
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
