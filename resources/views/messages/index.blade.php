@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <a class="btn-new-message" href="{{route('users.search')}}"><span><img class="icon-new-message" src="img/new-message.png" alt="new message"></span><p>Escribir nuevo mensaje</p></a>
    </div>

    <div class="central">
        <div class="messages">
            @foreach ($messages as $message)
            <a href={{route('messages.show', $message->id)}}>
                <div class="message">
                    <img src="{{ asset('storage/profile_pictures/'.$message->user->profile_picture) }}" alt="user">
                    <h4>{{$message->name}}</h4>
                </div>
            </a>
                <hr>
            @endforeach
        </div>
    </div>
    <div class="lateral-der">

    </div>

</main>

@endsection
