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
        @php
            $user = auth()->user();
            $pictures = $user->pictures;


        @endphp

        @forelse ($pictures as $picture)
            <img src="{{ asset('storage/pictures/' . auth()->user()->id . '/' . $picture->url . '.jpg') }}" alt="{{$picture->url}}">


        @empty
            <h2>Nada</h2>
        @endforelse
    </div>

    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>



@endsection


