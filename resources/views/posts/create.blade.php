<form action={{route('posts.store')}} method="POST" class="form-estado">
    @csrf

    <input type="hidden" name="user_id" value={{auth()->user()->id}}>
    <input type="text" name="content" placeholder="Actualiza tu estado" class="estado">
    <p id="estado-error">
        @error('content')
            Error: {{$message}}
        @enderror
    </p>
    <div class="ultima-act">
        <p id="ult-act"><b>Última actualización: </b></p>
        <input type="submit" value="Guardar" class="guardar">
    </div>

</form>




