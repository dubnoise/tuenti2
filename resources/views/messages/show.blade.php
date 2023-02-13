@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <h2>-</h2>
    </div>
    <div class="central">
        <div class="messages">
                <div class="message">
                    <img src={{asset('img/blank-user.jpg')}} alt="user">
                    <h4>{{$message->content}}</h4>
                </div>
        </div>
    </div>
    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>

@endsection
