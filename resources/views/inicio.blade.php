{{-- @extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')
@if (!Auth::check())

    @include('auth.login');

@else

    <header>
        @include('partials.header')
    </header>
    <main>
        @include('partials.main')
        @include('home')
    </main>

@endif

@endsection --}}
