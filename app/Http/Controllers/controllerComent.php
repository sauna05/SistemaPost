<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use App\Models\Post;
use Egulias\EmailValidator\Result\Reason\CommentsInIDRight;
use Illuminate\Http\Request;

class controllerComent extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request, Post $post)
    // {
    //     $request->validate([
    //         'content' => 'required'
    //     ]);
    
    //     $post->coments()->create($request->all());
    
    //     return redirect()->route('post.show', $post->id)->with('success', 'Comentario agregado');
    // }
   
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Coment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->id_post = $postId;
        $comment->save();

        return redirect()->back()->with('success', 'Comentario agregado exitosamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coment=Coment::findOrFail($id);
        $coment->delete();

        
        return redirect()->back()->with('success', 'Comentario eliminado exitosamente.');
    }
}
