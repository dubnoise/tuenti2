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

        <form action="{{ route('messages.store') }}" method="post">
            @csrf

            <textarea name="content" cols="30" rows="10" placeholder="Escribir mensaje..."></textarea>
            <input type="hidden" name="user_id" value={{auth()->user()->id}}>
            <input type="hidden" name="user_id_2" value={{$_GET['id']}}>
            <input type="submit" value="Enviar">
        </form>

    </div>
    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>

@endsection



