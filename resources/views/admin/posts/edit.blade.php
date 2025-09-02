<x-layouts.auth.admin>

    <div class="mb-4">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{route('admin.posts.index')}}">
                Posts
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                Editar
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{route('admin.posts.update',$post)}}" method="POST" class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4">    
        @csrf
        @method('PUT')
            <flux:input name="title" label="Titulo" value="{{old('title',$post->title)}}"/>
            <flux:input name="slug" label="Slug" value="{{old('slug',$post->slug)}}"/>
             <flux:select label="Categoria" name="category_id" >
                @foreach($categories as $category)
                    <flux:select.option value="{{$category->id}}" :selected="$category->id == old('category_id', $post->category_id)">
                        {{$category->name}}
                    </flux:select.option>
                @endforeach
            </flux:select>   
            <flux:textarea label="Resumen" name="excerpt">{{old('excerpt',$post->excerpt)}}</flux:textarea>
            <flux:textarea label="Contenido"  rows="16"  name="content">{{old('contet',$post->content)}}</flux:textarea>
            <div>
                <p class="text-sm font-semibold">Estado</p>
                <label >
                    <input type="radio" name="is_published" value="0" @checked(old('is_published',$post->is_published))>No publicado
                </label>
                <label >
                    <input type="radio" name="is_published" value="1" @checked(old('is_published',$post->is_published))>publicado
                </label>
            </div>
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Guardar</flux:button>
            </div>
    </form>
</x-layouts.auth.admin>