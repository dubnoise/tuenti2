@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')
@if (1 == 2)

@include('auth.login');

@else

@section('contenido')
<header>
    @include('partials.header')
</header>
<main>
    @include('partials.main')
</main>
@endif


@endsection
