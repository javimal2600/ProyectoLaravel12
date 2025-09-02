<x-layouts.auth.admin>

    <div class="mb-4">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{route('admin.posts.index')}}">
                Posts
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                Nuevo
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{route('admin.posts.store')}}" method="POST" class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4">    
        @csrf
            <flux:input name="title" label="Titulo" value="{{old('title')}}" oninput="string_to_slug(this.value, '#slug')"/>
            <flux:input name="slug" id="slug" label="Slug" value="{{old('slug')}}"/>

            <flux:select label="Categoria" name="category_id" >
                @foreach($categories as $category)
                    <flux:select.option value="{{$category->id}}":selected="$category->id == old('category_id')">
                        {{$category->name}}
                    </flux:select.option>
                @endforeach
            </flux:select>
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Guardar</flux:button>
            </div>
    </form>
</x-layouts.auth.admin>