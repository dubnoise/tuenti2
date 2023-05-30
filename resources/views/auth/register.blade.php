@extends('layout')

@section('titulo', 'Tuenti - Registro')

@section('contenido')

    <a href={{ route('home') }}>
        <div class="h1-tuenti">
            <img src="img/tuenti.png" alt="logo">
            <h1>tuenti</h1>
        </div>
    </a>
    <div class="registro">
        <div class="h4-registro">
            <h4>Registro</h4>
        </div>

        <div class="form-registro">
            <form action={{ route('registro') }} method="post">
                @csrf

                <label for="name">Nombre</label>
                <input class="input-registro placeholder-effect" type="text" name="name" id="name-input" placeholder="Introduce tu nombre" value="">
                <br>
                <label for="surname">Apellidos</label>
                <input class="input-registro placeholder-effect" type="text" name="surname" placeholder="Introduce tus apellidos">
                <br>
                <label for="email">Email</label>
                <input class="input-registro placeholder-effect" type="email" name="email" id="email" placeholder="Introduce tu email">
                <br>
                <label for="password">Contraseña</label>
                <input class="input-registro placeholder-effect" type="password" name="password" placeholder="Introduce tu contraseña">
                <br>
                <label for="country">País</label>
                <select class="input-registro" name="country" id="country">
                    <option value="España">España</option>
                </select>
                <br>
                <label for="city">Ciudad</label>
                <select class="input-registro" name="city" id="city">
                    <option value="Valencia">Valencia</option>
                    <option value="Alicante">Alicante</option>
                    <option value="Castellón">Castellón</option>
                </select>
                <br>
                <label for="birthdate">Fecha de nacimiento</label>
                <input class="input-registro" name="birthdate" type="date">
                <br>
                <div class="genre-class">
                    <label for="genre">Sexo</label>
                    <input type="radio" name="genre" value="Hombre" id="men">
                    <label for="men">Hombre</label>
                    <input type="radio" name="genre" value="Mujer" id="women">
                    <label for="women">Mujer</label>
                </div>
                <br>
                <div class="condiciones-de-uso">
                    <p><input type="checkbox">Aceptas las <a href="#">Condiciones de uso</a> y <a href="#">la
                            Política de privacidad</a> de Tuenti y que Tuenti te envíe comunicaciones, incluso por vía
                        electrónica.</p>
                    <br>
                    <p>Lee un resumen en el <a href="#">Decálogo de las Condiciones de uso</a></p>
                </div>
                <div class="continuar">
                    <input type="submit" value="Continuar">
                </div>
            </form>
            @if ($errors->any())
                <div class="errores-registro">
                    @foreach ($errors->all() as $error)
                        <p class="error-registro">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/register.js') }}"></script>

@endsection
