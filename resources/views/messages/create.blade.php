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

            <div class="nuevo-mensaje">
                <form action="{{ route('messages.store') }}" method="post">
                    @csrf
                    @foreach ($users as $user)
                        <h1>Mensaje para {{ $user->name }}</h1>

                    @endforeach
                    <textarea name="content" cols="30" rows="10" placeholder="Escribir mensaje..."></textarea>
                    <input type="hidden" name="user_id" value={{ auth()->user()->id }}>
                    <input type="hidden" name="user_id_2" value={{ $_GET['id'] }}>
                    <input type="submit" value="Enviar">
                </form>

            </div>

        </div>
        <div class="lateral-der">

        </div>

    </main>

@endsection
