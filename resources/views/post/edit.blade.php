<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="mb-4">
                <button>
                    <a href="{{ route('post.index') }}">
                        <img style="width: 2.5vw;" src="{{ asset('img/volver.jpg') }}" alt="Volver">
                    </a>
                </button>
            </div>
            <form action="{{ route('post.update', $post->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow-md" enctype="multipart/form-data">
                @csrf <!-- token CSRF -->
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Título</label>
                    <input type="text" value="{{ old('title', $post->title) }}" name="title" required class="border border-gray-300 dark:border-gray-600 rounded w-full p-2 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ingresa el título">
                    @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Contenido</label>
                    <textarea name="content" required class="border border-gray-300 dark:border-gray-600 rounded w-full p-2 focus:outline-none focus:ring focus:ring-green-300" placeholder="Escribe el contenido aquí...">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="imagen" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Imagen (opcional)</label>
                    <input type="file" name="imagen" class="border border-gray-300 dark:border-gray-600 rounded w-full p-2 focus:outline-none focus:ring focus:ring-green-300" accept="image/*">
                    <small class="text-gray-500">Deja este campo vacío si no deseas cambiar la imagen actual.</small>
                </div>

                <div>
                    <input style="background-color: green; color: white; width: 50%; border-radius: 6px;" type="submit" value="Editar" class="bg-green-500 text-white rounded px-4 py-2 w-full">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>