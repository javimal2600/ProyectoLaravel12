<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;//revisar que sea la correacta
use Illuminate\Routing\Controllers\HasMiddleware;//revisar que sea la correcta

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:manage permissions')
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        Permission::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Permiso creado',
            'text' => 'El permiso se creo con exito'
        ]);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
        return view('admin.permissions.show', compact('permission'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //


        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Permission $permission)
    {
        //
        $request->validate([
            'name'=>'required|string|max:255|unique:permissions,name,'.$permission->id,
        ]);

        $permission->update([
            'name'=>$request->name,
        ]);

         session()->flash('swal',[
            'icon'=>'success',
            'title'=>'Permiso actualizado',
            'text'=>'El permiso se actualizo con exito'
        ]);

        return redirect()->route('admin.permissions.edit',$permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
        $permission->delete();

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'Permiso eliminado',
            'text'=>'El permiso se elimino con exito'
        ]);

        return redirect()->route('admin.permissions.index');
    }
}
