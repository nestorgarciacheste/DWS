@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    @forelse ($posts as $post)
    <div>
        <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> ({{ $post->usuario->login }})</h2>
        <p>{{ $post->body }}</p>
    </div>
    @empty
    <p>No hay posts disponibles.</p>
    @endforelse

    {{ $posts->links() }} {{-- Si estás usando paginación --}}
</div>
@endsection