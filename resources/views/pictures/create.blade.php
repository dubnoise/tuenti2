<form action="{{ route('pictures.store') }}" name="pictures" method="POST" enctype="multipart/form-data" id="picture-form">
    @csrf

    <?php
        $path = storage_path('app/public/pictures/'.auth()->user()->id.'/*');
        $count = count(glob($path));
    ?>

    <label for="picture-input" class="upload-button">Subir fotos &uarr;</label>
    <input type="file" name="picture" id="picture-input" style="display: none;">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="url" value="{{ $count + 1 }}">
</form>

<script>
    document.getElementById('picture-input').addEventListener('change', function() {
        document.getElementById('picture-form').submit();
    });
</script>
