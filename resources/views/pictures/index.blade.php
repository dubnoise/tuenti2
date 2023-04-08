@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')
    @php
        $user = auth()->user();
        $pictures = $user->pictures;

    @endphp

    @forelse ($pictures as $picture)

        <img src="{{ asset('/pictures/1/1.jpg') }}" alt="{{$picture->url}}">

    @empty
        <h2>Nada</h2>
    @endforelse


@endsection


