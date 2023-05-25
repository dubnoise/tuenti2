<section class="login">
    @if (isset($error))
        <div class="error-login">
            <p>{{ $error }}</p>
        </div>
    @endif
    <form class="form-login" action={{route('login')}} method="POST">
        @csrf

        <label class="label-email" for="email">Email</label> <label class="label-contrasenya" for="contrasenya">Contraseña</label><br>
        <input type="email" name="email">
        <input type="password" name="password">
        <input class="boton-entrar" type="submit" value="Entrar">
        <div class="bajo-inputs">
            <div class="div-recordar">
                <input type="checkbox" name="recordar" id="recordar">
                <label id="label-recordar" class="label-recordar" for="recordar">Recordarme</label>
            </div>
            <div class="div-olvidado-contrasenya">
                <a href="#">¿Has olvidado tu contraseña?</a>
            </div>
        </div>
    </form>
</section>
<div class="linea-horizontal"></div>
<div class="quieres-una-cuenta">
    <a href={{route('registro')}}><p>¿Quieres una cuenta?</p></a>
</div>
<section class="article">
    <section class="que-es-tuenti">
        <div class="tuenti-contenido">
            <h1><img src="img/tuenti.png" alt="logo">tuenti</h1>
            <h2>¿Qué es Tuenti?</h2>
            <p>Tuenti es una plataforma social privada, a la que
                se accede únicamente por invitación. Cada día la
                usan millones de personas para comunicarse
                entre ellas y compartir información.
            </p>
        </div>
    </section>
    <div class="linea-vertical"></div>
    <section class="social-local-movil">
        <div class="social-contenido">
            <div class="social">
                <img src="img/social.png" alt="social">
                <h5>Social</h5>
                <p>Conéctate, comparte y comunícate con tus amigos, compañeros de trabajo y familia.</p>
            </div>

            <div class="local">
                <img src="img/local.png" alt="local">
                <h5>Local</h5>
                <p>Descubre servicios locales y participa con las marcas que realmente te importan</p>
            </div>

            <div class="movil">
                <img src="img/movil.png" alt="movil">
                <h5>Móvil</h5>
                <p>Accede a Tuenti desde tu móvil en tiempo real estés donde estés.</p>
            </div>
        </div>
    </section>
</section>
