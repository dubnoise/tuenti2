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
        <div class="fotos">
            @forelse ($pictures as $picture)
                <img src="{{ asset('storage/pictures/' . $picture->user_id . '/' . $picture->url . '.jpg') }}" alt="{{$picture->url}}">
            @empty

            @endforelse
        </div>
    </div>

    <div class="lateral-der">
    </div>

</main>

@endsection


