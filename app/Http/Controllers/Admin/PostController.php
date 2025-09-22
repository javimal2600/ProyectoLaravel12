<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::latest('id')->paginate();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data['user_id'] = auth()->id();

        $post = Post::create($data);
        
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post creado',
            'text' => 'El post se creo con exito'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        // $tags= $post->tags->pluck('id')->toArray();
        // $response= in_array($post->status,$tags);
        // dd($response);

        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //

        $data = $request->validate([
            'title' => 'required|max:255',
            // 'slug' => 'required|string|max:255|unique:posts,slug,'.$post->id,
            'slug'=>[
                Rule::requiredIf(function() use ($post){
                    return !$post->published_at;
                }),
                'string',
                'max:255',
                Rule::unique('posts')->ignore($post->id),
            ],
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required_if:is_published,1|string',
            'content' => 'required_if:is_published,1|string',
            'tags' => 'array',
            'is_published' => 'boolean'
        ]);

        if($request->hasFile('image')){
            if($post->image_path){
                Storage::delete($post->image_path);
            }
                $extension =$request->image->extension();
                $nameFile = $post->slug . '.' . $extension;
                while(Storage::exists('posts/'.$nameFile)){
                    $nameFile = str_replace('.'.$extension,'-copia.'.$extension ,$nameFile);
                }
                $data['image_path'] = Storage::put('posts',$request->image);
                
        }

        $post->update($data);

        $tags = [];
        foreach($request->tags ?? [] as $tag){
            $tags[]= Tag::firstOrCreate(['name' => $tag]);
        }

        $post->tags()->sync($tags);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post actualizado',
            'text' => 'El post se actualizo con exito'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
