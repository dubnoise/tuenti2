@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')
@include('partials.header')
<div class="novedades">
    @foreach ($posts as $post)
        <h2>{{$post->content}}</h2>
    @endforeach
</div>

@endsection


