@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<div class="novedades">
    @forelse ($posts as $post)
        <h2>{{$post->content}}</h2>
    @endforelse
</div>

@endsection


