<x-layouts.auth.admin>

    <div class="flex justify-between items-center mb-4">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{route('admin.users.index')}}">
                Users
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Editar
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a class="btn btn-blue text-xs" href="{{ route('admin.users.create') }}">
            Editar
        </a>
    </div>

     <form action="{{route('admin.users.update',$user)}}" method="POST" class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4">    
        @csrf
            @method('PUT')

            <flux:input name="name" label="Nombre" value="{{old('name',$user->name)}}"/>
            <flux:input type="email" name="email" label="Correo" value="{{old('email',$user->email)}}"/>
            <flux:input type="password" name="password" label="Contraseña"/>
            <flux:input type="password" name="password_confirmation" label="Confirmar Contraseña"/>

            <div>
                <p class="text-sm font-medium mb-1">Roles</p>
                <ul>
                    @foreach($roles as $role)
                        <li class="mb-1">
                            <label class="flex items-center space x-2">
                                <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-checkbox h-4 w-4 text-blue-600"
                                @checked(in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())))>
                                <span class="ml-2 text-sm text-gray-700">{{$role->name}}</span>
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