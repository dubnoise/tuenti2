@extends('layout')

@section('titulo', 'Tuenti - Registro')

@section('contenido')

    <a href={{route('inicio')}}>
        <div class="h1-tuenti">
            <img src="img/tuenti.png" alt="logo"><h1>tuenti</h1>
        </div>
    </a>
    <div class="registro">
        <div class="h4-registro">
            <h4>Registro</h4>
        </div>

        <div class="form-registro">
            <form action={{route('registro')}} method="post">
                @csrf

                <label for="name">Nombre</label>
                <input class="input-registro" type="text" name="name">
                <br>
                <label for="surname">Apellidos</label>
                <input class="input-registro" type="text" name="surname">
                <br>
                <label for="email">Email</label>
                <input class="input-registro" type="email" name="email" id="email">
                <br>
                <label for="password">Contraseña</label>
                <input class="input-registro" type="password" name="password">
                <br>
                <label for="country">País</label>
                <select class="input-registro" name="country" id="country">
                    <option value="españa">España</option>
                </select>
                <br>
                <label for="city">Ciudad</label>
                <select class="input-registro" name="city" id="city">
                    <option value="valencia">Valencia</option>
                    <option value="alicante">Alicante</option>
                    <option value="castellon">Castellón</option>
                </select>
                <br>
                <label for="birthdate">Fecha de nacimiento</label>
                <input class="input-registro" name="birthdate" type="date">
                <br>
                <div class="genre-class">
                    <label for="genre">Sexo</label>
                    <input type="radio" name="genre" value="hombre" id="men">
                    <label for="men">Hombre</label>
                    <input type="radio" name="genre" value="mujer" id="women">
                    <label for="women">Mujer</label>

                    {{-- <input type="text" name="genre"> --}}
                </div>
                <br>
                <div class="condiciones-de-uso">
                    <p><input type="checkbox">Aceptas las <a href="#">Condiciones de uso</a> y <a href="#">la Política de privacidad</a> de Tuenti y que Tuenti te envíe comunicaciones, incluso por vía electrónica.</p>
                    <br>
                    <p>Lee un resumen en el <a href="#">Decálogo de las Condiciones de uso</a></p>
                </div>
                <div class="continuar">
                    <input type="submit" value="Continuar">
                </div>
            </form>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection
