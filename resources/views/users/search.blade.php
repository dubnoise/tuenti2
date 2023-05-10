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

            @foreach ($users as $user)
                <div class="busqueda-usuarios">

                    <div class="foto-y-datos-busqueda">
                        <a href="{{ route('users.show', $user->id) }}"><img src="{{ asset('storage/profile_pictures/'.$user->profile_picture) }}" alt="profile-image"></a>
                        <div class="datos-busqueda">
                            <a href="{{ route('users.show', $user->id) }}">{{$user->name}}</a>
                            <p>Ubicación: <b>{{ $user->country }}</b></p>
                            <p>Fecha de nacimiento: <b>{{ date('d/m/Y', strtotime($user->birthdate)) }}</b></p>
                        </div>

                    </div>

                    <div class="botones-usuarios-busqueda">
                        <a href="{{ route('messages.create', 'id='.$user->id) }}">Mensaje privado</a>
                        <a href="#">Más acciones</a>
                    </div>
                    <hr>
                </div>


                    {{-- <a href={{route('messages.create', 'id='.$user->id)}}>
                        <div class="message">
                            <h1>{{$user->name}}</h1>
                        </div>
                    </a> --}}

            @endforeach

        @else
            <p>No se encontraron resultados.</p>
        @endif

    </div>
    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>

@endsection


