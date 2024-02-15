@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->titulo }}</h1>
    <p>{{ $post->contenido }}</p>
    <p>Fecha de creación: {{ $post->created_at->format('d/m/Y') }}</p>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este post?')">Eliminar Post</button>
    </form>
</div>
@endsection