<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <button>
            <a href="{{route('post.index')}}">
                <img style="width: 2.5vw;" src="{{ asset('img/volver.jpg') }}" alt="Volver">
            </a>
        </button>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">

            {{-- <div class="mb-4">
                @if ($post->imagen)
                <img src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen del Post" class="mt-2 mb-2 rounded-lg" style="width: 8%; height: auto;position: absolute;left: 40%;">
                    
                @endif
            </div> --}}
            <div class="mb-4" >
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Título</label>
                <p class="text-lg font-bold">{{ $post->title }}</p>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Contenido</label>
                <p class="text-gray-800 dark:text-gray-300">{{ $post->content }}</p>
               
                @php $contador = 0; @endphp
                @foreach ($post->coments as $comment)
                    @php $contador++; @endphp
                @endforeach

                <h2 class="text-xl font-semibold mt-4">{{ $contador }} Comentario{{ $contador !== 1 ? 's' : '' }}</h2>
                <h3 class="text-lg font-semibold mt-6">Añade un comentario</h3> 
                
                <form action="{{ route('comment.store', $post->id) }}" method="POST"> 
                    @csrf 
                    <textarea name="content" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2 border border-gray-300 rounded-lg p-2 w-full" id="content" required 
                       placeholder="Escribe aquí tu comentario del post."></textarea> 
                    <br>
                    <button style="background-color: blue;color: white;border-radius: 10px;width: 8vw; height: 2vw;position: relative;margin-bottom: 2vw"  type="submit">Comentar</button> 
                </form>
                @php $contador = $post->coments->count(); @endphp  
                @if ($contador >0)

                      
                @foreach ($post->coments as $comment)
                    <div class="border border-gray-300 rounded-lg p-4 mb-4 bg-gray-100 dark:bg-gray-800">
                        <p class="font-semibold">{{ $comment->content }}</p>
                        <small class="text-gray-500">Comentado por : {{$post->User->name }} </small>
                        <br>
                        <small class="text-gray-500">Publicado el: {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                        @auth
                            @if (auth()->user()->id==$comment->user_id)
                            <form onclick="return confirm('Esta seguro que deseha eliminar el comentario')" action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="display:inline;" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <img style="width: 12px;" src="{{ asset('img/eliminar.png') }}" alt="Eliminar">
                                </button>
                            </form>
                                
                            @endif
                        @endauth
                        
                        
                    </div>
                @endforeach                    
                @else
                  
                  <p>no hay comentarios</p>

                @endif
             

            </div>
        </div>
    </div>
</x-app-layout>