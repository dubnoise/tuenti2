@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">

    </div>
    <div class="central">
        <div class="messages">
                <div class="message">
                    <img src="{{ asset('storage/profile_pictures/'.$message->user->profile_picture) }}" alt="user">
                    <h4>{{$message->content}}</h4>
                </div>
        </div>
    </div>
    <div class="lateral-der">

    </div>

</main>

@endsection
