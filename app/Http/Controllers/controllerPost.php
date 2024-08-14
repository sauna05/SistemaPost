<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class controllerPost extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $post = Post::with('User')->orderBy('created_at', 'desc')->get();
        return view('post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'content' => 'required',
    //         ]);
    //         Post::create($request->all());
    //         return redirect()->route('post.index')->with('success', 'Post creado exitosamente.');   

    // }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id();
    
        // Manejo de la imagen
        if ($request->hasFile('imagen')) { 
            $imagePath = $request->file('imagen')->store('images', 'public'); // Guarda la imagen en el disco 'public/images'
            $post->imagen = $imagePath; 
        }
    
        $post->save();
    
        return redirect()->route('post.index')->with('success', 'Post creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);

        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
            
            $this->authorize('update', $post); // Autorizar
    
            return view('post.edit', compact('post'));
        } catch (AuthorizationException $e) {
            return redirect()->route('post.index')->with('error', 'No tiene permiso para editar este post.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar de nuev
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Encontrar el post por ID
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
    
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            if ($post->imagen) {
                // Eliminar la imagen anterior del almacenamiento
                Storage::disk('public')->delete($post->imagen);
            }
            // Guardar la nueva imagen
            $imagePath = $request->file('imagen')->store('images', 'public');
            $post->imagen = $imagePath; 
        }
        // Guardar los cambios en la base de datos
        $post->save();
        return redirect()->route('post.index')->with('success', 'Post actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
    
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Post borrado exitosamente.');
        } catch (AuthorizationException $e) {
            return redirect()->route('post.index')->with('error', 'No tiene permiso para eliminar este post.');
        }
    }
    public function search(Request $request)
{
    // Validar la entrda de datos
    $request->validate([
        'buscador' => 'required|string|max:255',
    ]);
    $searchTerm = $request->input('buscador');


    $post = Post::where('title', 'LIKE', '%' . $searchTerm . '%')
                 ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
                 ->get();


    return view('post.index', compact('post'));
}
}
