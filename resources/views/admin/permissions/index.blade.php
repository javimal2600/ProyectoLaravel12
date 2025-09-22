<x-layouts.auth.admin>

    <div class="flex justify-between items-center mb-4">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Permisos
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a class="btn btn-blue text-xs" href="{{ route('admin.permissions.create') }}">
            Nuevo
        </a>
    </div>
    
    
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3" width="200">
                    Editar
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $permission->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $permission->name }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{route('admin.permissions.edit',$permission)}}" class="text-xs test btn btn-green">Editar</a>
                    <form class="delete-form" action="{{route('admin.permissions.destroy',$permission)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs btn btn-red">Eliminar</button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('js')
    <script>
        document.querySelectorAll('.delete-form').forEach(form=>{
            form.addEventListener('submit',(e)=>{
                e.preventDefault();
                    Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Si, eliminarlo!",
                    cancelButtonText: "Cancelar",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                    });
                })
            })
    </script>   
@endpush
</x-layouts.auth.admin>