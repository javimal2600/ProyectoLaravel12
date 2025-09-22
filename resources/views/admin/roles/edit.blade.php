<x-layouts.auth.admin>

    <div class="flex justify-between items-center mb-4">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{route('admin.roles.index')}}">
                Roles
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Editar
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a class="btn btn-blue text-xs" href="{{ route('admin.roles.create') }}">
            Editar
        </a>
    </div>

     <form action="{{route('admin.roles.update',$role)}}" method="POST" class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4">    
        @csrf
        @method('PUT')
            <flux:input name="name" label="Nombre" value="{{old('name',$role)}}"/>
            <div>
                <p class="text-sm font-medium mb-1">Permisos</p>
                <ul>
                    @foreach($permissions as $permission)
                        <li class="mb-1">
                            <label class="flex items-center space x-2">
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="form-checkbox h-4 w-4 text-blue-600"
                                @checked(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())))>
                                <span class="ml-2 text-sm text-gray-700">{{$permission->name}}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Actualizar</flux:button>
            </div>
    </form>

    </x-layouts.auth.admin>