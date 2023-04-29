@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')
    @if (!Auth::check())

        @include('auth.login');
    @else
        <header>
            @include('partials.header')
        </header>

        <main>
            <div class="lateral-izq">
                <h2>-</h2>
            </div>

            <div class="central">
                <form action={{ route('posts.store') }} method="POST" class="form-estado">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="text" name="content" placeholder="Actualiza tu estado" class="estado">
                    <p id="estado-error">
                        @error('content')
                            Error: {{ $message }}
                        @enderror
                    </p>

                    <div class="ultima-act">
                        <p id="ult-act"><b>Última actualización:</b> <?php echo $lastPost->content ?? ''; echo ' '; echo $duracion ; ?></p>
                        <input type="submit" value="Guardar" class="guardar">
                    </div>

                </form>

                <div class="novedades">
                    <h3>Novedades de tus amigos</h3>
                    <hr>
                    @forelse ($posts as $post )
                        <div class="novedad">
                            <a href="{{ route('users.show', $post->user->id) }}">
                                @if ($hasProfilePicture)
                                    <img src="{{ asset('storage/profile_pictures/'.$post->user->profile_picture) }}" alt="{{ $post->user->profile_picture }}">
                                @else
                                    <img src="{{ asset('storage/profile_pictures/default.jpg') }}" alt="default">
                                @endif
                            </a>

                            <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}
                                {{ $post->user->surname }}</a>
                            <p>{{ $post->content }}</p>
                        </div>
                    @empty
                        <h2>No hay estados que mostrar</h2>
                    @endforelse

                    @forelse ($pictures as $picture)
                        <div class="novedad">
                            <a href="{{ route('users.show', $picture->user->id) }}">
                                @if ($hasProfilePicture)
                                    <img src="{{ asset('storage/profile_pictures/'.$picture->user->profile_picture) }}" alt="{{ $picture->user->profile_picture }}">
                                @else
                                    <img src="{{ asset('storage/profile_pictures/default.jpg') }}" alt="default">
                                @endif
                            </a>
                            <a href="{{ route('users.show', $picture->user->id) }}">{{ $picture->user->name }}
                                {{ $picture->user->surname }}</a>
                                <img src="{{ asset('storage/pictures/' . $picture->user->id . '/' . $picture->url . '.jpg') }}" alt="{{$picture->url}}">
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>

            <div class="lateral-der">
                <h2>-</h2>
            </div>

        </main>

    @endif

@endsection
