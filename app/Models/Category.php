<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Category extends Model
{
    //
    use HasFactory;
    protected $fillable = ['name'];

    //relacion uno a muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
