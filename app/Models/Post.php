<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 
        'slug',
        'image_path', 
        'excerpt',
        'content',
        'is_published',
        'published_at',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    //relacion inversa uno a muchos
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relacion inversa uno a muchos
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion uno a muchos
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //relacion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);    
    }
}
