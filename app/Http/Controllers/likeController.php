<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Auth;
use Illuminate\Http\Request;

class likeController extends Controller
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
    // public function store(Request $request, $postId)
    // {
    //     $like = new Like();
    //     $like->user_id = auth()->id();
    //     $like->post_id = $postId;
    //     $like->save();

    //     return redirect()->back();
    // }
    
    public function store($postId)
    {
        $userId = Auth::id();
        
        $like = Like::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($like) {
            // Si el like existe, eliminarlo
            $like->delete();
        } else {
            // Si no existe, crear un nuevo like
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId,
            ]);
        }

        return back(); // Redirigir de vuelta a la página anterior
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
