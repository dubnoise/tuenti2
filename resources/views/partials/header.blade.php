<div class="cabecera">
    <div class="cabecera-1">
        <a href={{route('inicio')}}>
            <div class="logo">
                <img src={{asset('img/tuenti.png')}} alt="logo"><h1>tuenti</h1>
            </div>
        </a>

        <nav>
            <ul>
                <a href={{route('inicio')}}><li>Inicio</li></a>
                <a href={{route('users.show', auth()->user()->id)}}><li>Perfil</li></a>
                <a href="#"><li>Mensajes</li></a>
                <a href="#"><li>Gente</li></a>
            </ul>
        </nav>

        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Buscar...">
        </form>

        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="file" name="subir_fotos" multiple>
        </form>
    </div>
    <div class="cabecera-2">
        <nav>
            <ul>
                <a href="#"><li>Mi cuenta</li></a>
                <a href={{route('logout')}}><li>Salir</li></a>
            </ul>
        </nav>
    </div>
</div>
