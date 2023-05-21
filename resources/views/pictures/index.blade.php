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
        @forelse ($pictures as $picture)
            <img src="{{ asset('storage/pictures/' . $picture->user_id . '/' . $picture->url . '.jpg') }}" alt="{{$picture->url}}">
        @empty

        @endforelse
    </div>

    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>

@endsection


