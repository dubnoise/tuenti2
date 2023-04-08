<form action="{{route('pictures.store')}}" name="pictures" method="POST" enctype="multipart/form-data">
    @csrf

    <?php
        $path = storage_path('app/public/pictures/'.auth()->user()->id.'/*');
        $count = count(glob($path));
    ?>

    <input type="file" name="picture">
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <input type="hidden" name="url" value={{$count+1}}>
    <input type="submit" value="Subir foto">
</form>
