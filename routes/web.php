<?php

use App\Http\Controllers\controllerComent;
use App\Http\Controllers\controllerPost;
use App\Http\Controllers\likeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Ruta para agregar un comentario
Route::post('posts/{post}/comment', [controllerComent::class, 'store'])->name('comment.store'); 


// Ruta para eliminar un comentario
Route::delete('comments/{comment}', [controllerComent::class, 'destroy'])->name('comment.destroy'); 

//ruta para agregar likes
Route::post('posts/{post}/like', [likeController::class, 'store'])->name('like.store');

Route::post('/post/search', [controllerPost::class, 'search'])->name('post.search');

// Rutas de recursos para los posts
Route::resource('post', controllerPost::class);