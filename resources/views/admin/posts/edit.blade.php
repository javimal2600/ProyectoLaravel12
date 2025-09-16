<x-layouts.auth.admin>

    @push('css')
            <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
        
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

    <form action="{{route('admin.posts.update',$post)}}" method="POST" enctype="multipart/form-data">    

        @csrf
        @method('PUT')

        <div class="relative mb-2">
            <img id="imgPreview" class="w-full aspect-video object-cover object-center"  src="{{$post->image_path ? Storage::url($post->image_path) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'}}" alt="">
            <div class="absolute top-8 right-8">
                    <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">Cambiar Imagen
                        <input class="hidden" type="file" name="image" accept="=image/*" onchange="preview_Image(event, '#imgPreview')">
                    </label>
            </div>
        </div>


        <div class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4">
                <flux:input name="title" label="Titulo" value="{{old('title',$post->title)}}"/>
                @if (!$post->published_at)
                    <flux:input name="slug" label="Slug" value="{{old('slug',$post->slug)}}"/>
                @endif
                <flux:select label="Categoria" name="category_id" >
                    @foreach($categories as $category)
                        <flux:select.option value="{{$category->id}}" :selected="$category->id == old('category_id', $post->category_id)">
                            {{$category->name}}
                        </flux:select.option>
                    @endforeach
                </flux:select>   
                <flux:textarea label="Resumen" name="excerpt">{{old('excerpt',$post->excerpt)}}</flux:textarea>
                
                <div>
                    <p class="font-medium text-sm mb-1">
                        Etiquetas
                    </p>
                    <select id="tags" name="tags[]" style="width: 100%" multiple="multiple">
                        @foreach($tags as $tag)
                            <option value="{{$tag->name}}" @selected(in_array($tag->name, old('tags', $post->tags->pluck('name')->toArray())))>
                                {{$tag->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <p class="font-medium text-sm mb-1">
                        Cuerpo
                    </p>
                        <div id="editor">{!!old('content',$post->content)!!}</div>
                            <textarea class="hidden" name="content" id="content">{{old('content',$post->content)}}</textarea>
                    </div>
                </div>
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
            </div>
    </form>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                document.getElementById('content').value = quill.root.innerHTML;
            });
        </script>

        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tags').select2({
                    tags: true,
                    tokenSeparators: [',']
                });
            });
        </script>
    @endpush

</x-layouts.auth.admin>