<x-app-layout class="w-16">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts Realizados') }}
        </h2>

        <form action="{{ route('post.search') }}" method="POST" class="flex items-center mb-6">
            @csrf
            <input type="text" name="buscador" placeholder="Buscar por título o contenido" class="border rounded-lg px-4 py-2 w-full mr-2" required>
            <div class="w-16 md:w-32 lg:w-48"></div> 
            <button class="border rounded-lg" style="position: absolute; background-color: blue; color: white; width: 8vw; margin-top: 6vw" type="submit">
                Buscar
            </button>
        </form>
    </x-slot>

    <div class="py-12 " >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <ul>
                <button>
                    <a href="{{ route('post.index') }}">
                        <img style="width: 3vw;" src="{{ asset('img/refresh.png') }}" alt="Volver">
                    </a>
                </button>
                <li class="mb-4">
                    <button style="width: 8vw; height: 2vw; color: white; border-radius: 6px; background-color: green;">
                        <a href="{{ route('post.create') }}">Publicar post</a>
                    </button>
                </li>
                
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div style="background-color: green; color: white; width: 100%; border-radius: 6px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (count($post) > 0)
                    @foreach ($post as $p)
                        <li class="mb-4">
                            <hr class="my-2" style="border: 1px solid gray;">
                            <small>fecha publicaciòn   {{$p->created_at}}</small>
                            <br>
                            <small>publicado por  {{$p->User->name}}</small>
                            <h3 class="font-bold text-lg">{{ $p->title }}</h3>
                            <p>{{ $p->content }}</p>
                           
                            <button style="width: 70vw">
                                <a href="{{route('post.show',$p->id)}}">
                                    @if ($p->imagen)
                                   <img src="{{ asset('storage/' . $p->imagen) }}" alt="Imagen del Post" class="mt-2 mb-2 rounded-lg" style="width: 30%; height: auto;">
                                 @endif
                                </a>
                            </button>
                           
  
                            @auth
                                @if (auth()->user()->id == $p->user_id)
                                    <button>
                                        <a href="{{ route('post.edit', $p->id) }}">
                                            <img style="width: 20px;" src="{{ asset('img/editar.png') }}" alt="Editar">
                                        </a>
                                    </button>
                                    <form action="{{ route('post.destroy', $p->id) }}" method="POST" style="display:inline;" onclick="return eliminar()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <img style="width: 20px;" src="{{ asset('img/eliminar.png') }}" alt="Eliminar">
                                        </button>
                                    </form>
                                @endif
                            @endauth

                            <button>
                                <a href="{{ route('post.show', $p->id) }}">
                                    <img style="width: 20px;" src="{{ asset('img/comentario.png') }}" alt="Comentarios">
                                </a>
                            </button>

                            <form action="{{ route('like.store', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <img style="width: 20px;" src="{{ asset('img/like.png') }}" alt="Like">
                                </button>
                            </form>
                            <span class="ml-2 text-gray-500">{{ $p->likes->count() }}</span>
                        </li>
                    @endforeach
                @else
                    <li class="mb-4">
                        <p>No se encontraron resultados.</p>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <script>
        //funcion que retorna false true 
        function eliminar() {
            return confirm("¿Seguro que desea eliminar esta publicación?");
        }
    </script>
    @include('layouts.foter')
</x-app-layout>