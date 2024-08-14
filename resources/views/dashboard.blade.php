<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sitio web de post') }}
        </h2>
    </x-slot>
<!-- contenido de slot principal -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md" >
                <!-- aqui el listado de persona -->
                 <p> Bienvenido al sistema de posts</p>
                 <p class="text-gray-700 dark:text-gray-300">
                        Gracias por unirte a nuestro sistema de gestión de posts. Aquí puedes crear, editar y gestionar tus publicaciones de manera sencilla.
                    </p>
                    <button>
                        <a href="{{route('post.index')}}"> <img style="width: 100vw;" src="{{ asset('img/post_welcome.png') }}" alt=""></a>
                    </button>
                
              
            </div>
        </div>
      
    </div>
</x-app-layout>


