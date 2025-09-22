<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;//revisar que sea la correacta
use Illuminate\Routing\Controllers\HasMiddleware;//revisar que sea la correcta

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:manage categories')
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = category::orderby('id','desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data= $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        category::create($data);

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'Categoria creada',
            'text'=>'La categoria se creo con exito'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
        $data= $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
        ]);

        $category->update($data);

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'Categoria actualizada',
            'text'=>'La categoria se actualizo con exito'
        ]);

        return redirect()->route('admin.categories.edit',$category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        //
        $category->delete();

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'Categoria eliminada',
            'text'=>'La categoria se elimino con exito'
        ]);

        return redirect()->route('admin.categories.index');
    }
}
