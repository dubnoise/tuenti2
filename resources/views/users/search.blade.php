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

        <form action="{{ route('users.search') }}" method="GET">
            <div class="form-group">
                <label for="q">Buscar usuario:</label>
                <input type="text" id="q" name="q" class="form-control" value="{{ request('q') }}" required>
            </div>

            <button type="submit">Buscar</button>
        </form>

        <hr>

        @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>

                            <a href={{route('messages.create', 'id='.$user->id)}}>
                                <div class="message">
                                    <h1>{{$user->name}}</h1>
                                </div>
                            </a>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No se encontraron resultados.</p>
        @endif


    </div>
    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>

@endsection


