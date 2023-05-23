<div class="cabecera">
    <div class="cabecera-1">
        <a href={{route('home')}}>
            <div class="logo">
                <img src={{asset('img/tuenti.png')}} alt="logo"><h1>tuenti</h1>
            </div>
        </a>

        <nav>
            <ul>
                <a href="{{ route('home') }}"><li>Inicio</li></a>
                <a href="{{ route('users.show', auth()->user()->id) }}"><li>Perfil</li></a>
                <a href="{{ route('messages.index') }}"><li>Mensajes</li></a>
                <a href="/users/search/"><li>Gente</li></a>
            </ul>
        </nav>

        <form action="{{ route('users.search') }}" method="GET" enctype="multipart/form-data">
            <input type="text" id="q" name="q" class="form-control" value="{{ request('q') }}" placeholder="Buscar...">
            <button style="display: none" type="submit">Buscar</button>
        </form>

        @include('pictures.create')

    </div>
    <div class="cabecera-2">
        <nav>
            <ul>
                <a href="{{ route('users.edit', auth()->user()->id) }}"><li>Mi cuenta</li></a>
                <a href={{route('logout')}}><li>Salir</li></a>
            </ul>
        </nav>
    </div>
</div>
