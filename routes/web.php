<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;

// Route untuk halaman home
Route::view('/', 'home');

// Route untuk halaman about
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

// Route untuk halaman contact
Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

// Route untuk menampilkan semua post yang ditulis oleh seorang penulis (author)
Route::get('/authors/{user:username}', function (User $user) {
    return view('posts.index', [
        'title' => count($user->posts) . ' Articles by ' . $user->name,
        'posts' => $user->posts
    ]);
});

// Route untuk menampilkan semua post yang berada dalam sebuah kategori
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts.index', [
        'title' => count($category->posts) . ' Articles in ' . $category->name,
        'posts' => $category->posts
    ]);
});


Route::get('posts', [PostController::class, 'index']);
Route::get('posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('posts', [PostController::class, 'store']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::get('posts/{post:slug}/edit', [PostController::class, 'edit'])
    ->middleware('auth')
    ->can('edit','post');
Route::patch('posts/{post:slug}', [PostController::class, 'update'])
    ->middleware('auth')
    ->can('update', 'post');
Route::delete('posts/{post:slug}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->can('delete', 'post');



Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
