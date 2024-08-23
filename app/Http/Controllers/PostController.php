<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Post;
use App\Models\User;
use App\Mail\PostMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{

    public function index()
    {
        return view('posts.index', [
            'title' => 'Blog',
            'posts' => Post::filter(request(['search', 'category', 'author']))
                ->latest()
                ->paginate(12)
                ->withQueryString() // Memastikan query string tetap ada saat berpindah halaman
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['title' => 'Single post', 'post' => $post]);
    }

    // Menampilkan form untuk membuat post baru
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori dari database

        return view('posts.create', [
            'title' => 'Create Post',
            'categories' => $categories
        ]);
    }

    // Menyimpan data post baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);


        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'slug' => \Str::slug($validated['title']),
            'author_id' => auth()->id()
        ]);

        Mail::to($post->author)->send(new PostMail($post));

        return redirect('/posts')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {

        $categories = Category::all();
        return view('posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => $categories // Menyediakan kategori untuk dropdown dalam form
        ]);
    }

    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        // Validasi data yang diterima
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Buat slug baru dari title
        $newSlug = \Str::slug($validated['title']);

        // dd($newSlug);

        // Pastikan slug unik
        $existingPost = Post::where('slug', $newSlug)->first();
        if ($existingPost && $existingPost->id !== $post->id) {
            return redirect()->back()->withErrors(['slug' => 'The generated slug is already in use. Please choose a different title.']);
        }

        // Update data post
        $post->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'slug' => $newSlug,
        ]);

        // dd($post->fresh());

        // Redirect dengan slug yang baru
        return redirect('/posts/' . $newSlug)->with('success', 'Post updated successfully!');
    }



    public function destroy(Post $post)
    {
        // Hapus post
        $post->delete();

        // Redirect dengan pesan sukses
        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }



}
