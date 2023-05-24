@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <div class="profile-izq">
            @if ($profilePicture)
                <img src="{{ $profilePicture }}" alt="{{ $user->profile_picture }}">
            @else
                <img src="{{ asset('storage/profile_pictures/default.jpg') }}" alt="default">
            @endif

            <h3>Información</h3>
            <hr>
            <ul>
                <li><b>Nombre:</b> {{$user->name}}</li>
                <li><b>Apellidos:</b> {{$user->surname}}</li>
                <li><b>País:</b> {{$user->country}}</li>
                <li><b>Ciudad:</b> {{$user->city}}</li>
                <li><b>Sexo:</b>
                    @if ($user->genre != "")
                        {{$user->genre}}
                    @else
                        ¿?
                    @endif
                </li>
                <li><b>Fecha de nacimiento:</b> {{ date('d/m/Y', strtotime($user->birthdate)) }}</li>

            </ul>
        </div>
    </div>

    @if(auth()->user()->isFriendWith($user) || $user->isFriendWith(auth()->user()))
        <div class="central">
            <div class="nombre-perfil">
                <h3>{{ $user->name }} {{ $user->surname }}</h3>
            </div>
            @if(auth()->user() != $user && auth()->user()->isFriendWith($user))

            <form action="{{ route('friendship.deleteFriend', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-user" type="submit" onclick="return confirm(`¿Está seguro de que desea eliminar a {{ $user->name }} {{ $user->surname }} de la lista de amigos?`)">Eliminar amigo</button>

            </form>
        @endif

            <div class="mensaje-privado-perfil">
                <a href="{{ route('messages.create', 'id='.$user->id) }}">Mensaje privado</a>
            </div>

            <div class="ultimo-estado-perfil">
                @if(isset($lastPost->content))
                    <div class="ultimo-estado">
                        <h3>{{ $lastPost->content }}</h3>
                        <p>{{ $duracion }}</p>
                    </div>

                    @if(auth()->check() && $lastPost->user_id === auth()->user()->id)
                        <form action="{{ route('posts.destroy', $lastPost->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="eliminar-estado">
                                <input class="eliminar-estado-btn" type="submit" value="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este post?')">
                            </div>
                        </form>
                    @endif
                @else
                    <p>Sin estado que mostrar.</p>
                @endif
            </div>
            <hr>
            <br>
            <br>
            <h3 style="margin-left: .6em; margin-bottom: .4em;">Tablón</h3>

            <form method="post" action="{{ route('comments.store', $user->id) }}">
                @csrf
                <div class="form-group">
                    <img src="{{ asset('storage/profile_pictures/'.auth()->user()->profile_picture) }}" alt="{{ auth()->user()->profile_picture }}">
                    <input type="text" class="form-control" name="content" id="content" placeholder="Escribe aquí..." />
                </div>
                <button style="display: none" type="submit">Enviar comentario</button>
            </form>

            @if($user->comments->count() > 0)
                <div class="comments">
                    @foreach($user->comments()->orderByDesc('created_at')->get() as $comment)
                        <div class="comment">
                            <p>
                                <a href="{{ route('users.show', $comment->user->id) }}">
                                    <img src="{{ asset('storage/profile_pictures/'.$comment->user->profile_picture) }}" alt="img">
                                </a>
                                <div>
                                    <span>
                                        <a href="{{ route('users.show', $comment->user->id) }}">
                                            {{ $comment->user->name }} {{ $comment->user->surname }}
                                        </a>
                                        <h3>{{ $comment->created_at->formatLocalized('%e de %B de %Y, a las %H:%M') }}</h3>
                                    </span>
                                    <span>{{ $comment->content }}</span>
                                </div>
                            </p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="lateral-der">
            <div class="container-fotos-perfil">
                <h4>Fotos</h4>
                <hr>
                @php
                    $userPictures = $user->pictures()->orderBy('created_at', 'desc')->take(6)->get();
                @endphp
                <div class="album-fotos-perfil">
                    @forelse ($userPictures as $picture)
                        <img src="{{ asset('storage/pictures/' . $picture->user_id . '/' . $picture->url . '.jpg') }}" alt="{{$picture->url}}">
                    @empty
                        <p>...</p>
                    @endforelse
                </div>
                <br>
                <hr>
                <br>
                <a href="/pictures/{{$user->id}}">Ver todas <span>({{ $user->pictures()->count() }})</span></a>
            </div>
            <h4>Amigos</h4>
            <br>
            <hr>
    <div class="amigos-perfil">
        @forelse ($userFriends as $friend)
            <div class="amigo">
                <a href="{{ route('users.show', $friend->id) }}"><img src="{{ asset('storage/profile_pictures/'.$friend->profile_picture) }}" alt="{{ $friend->name }}"></a>
                <a href="{{ route('users.show', $friend->id) }}"><p>{{ $friend->name }} {{ $friend->surname }}</p></a>
            </div>
        @empty
            <p>...</p>
        @endforelse
    </div>
    <br>
    <hr>
    <br>
    <a class="verTodosAmigos" href="">Ver todos <span>({{ $userFriends->count() }})</span></a>
    <br>
        </div>
    @else

    <div class="central">
        @if(!auth()->user()->isFriendWith($user) && !$user->hasFriendRequestFrom(auth()->user()))
            <form action="{{ route('friendship.sendRequest', $user->id) }}" method="post">
                @csrf
                <button class="btn-user" type="submit">Enviar solicitud de amistad</button>
            </form>
        @endif

        @if($user->hasFriendRequestFrom(auth()->user()))
            <form action="{{ route('friendship.cancelRequest', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-user" type="submit">Cancelar solicitud de amistad</button>
            </form>
        @endif

        <div class="mensaje-privado-perfil">
            <a href="{{ route('messages.create', 'id='.$user->id) }}">Mensaje privado</a>
        </div>
    </div>

    @endif

</main>

@endsection
