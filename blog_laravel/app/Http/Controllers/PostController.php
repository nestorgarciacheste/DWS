<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('title')->paginate(5);
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(PostRequest $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:50',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->usuario_id = 1;

        if ($post->save()) {
            return redirect()->route('posts.index')->with('success', 'Post creado correctamente.');
        } else {
            return back()->withInput()->with('error', 'No se pudo crear el post.');
        }
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }


    public function edit($id)
    {
        return redirect('/');
    }


    public function update(PostRequest $request, $id)
    {
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index')->with('success', 'Post eliminado correctamente.');
    }

    public function nuevoPrueba()
    {
        $post = new Post();
        $post->titulo = 'Título ' . rand(1, 100);
        $post->contenido = 'Contenido ' . rand(1, 100);
        $post->save();

        return redirect()->route('posts.index');
    }

    public function editarPrueba($id)
    {
        $post = Post::findOrFail($id);
        $post->titulo = 'Título Editado ' . rand(101, 200);
        $post->contenido = 'Contenido Editado ' . rand(101, 200);
        $post->save();

        return redirect()->route('posts.show', $id);
    }
}
