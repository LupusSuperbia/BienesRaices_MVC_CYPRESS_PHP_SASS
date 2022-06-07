<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo Blog:</label>
    <input type="text" name="blogs[titulo]" id="titulo" placeholder="Titulo blogs" value="<?php echo s($blogs->titulo); ?>">

    <label for="autor">Nombre del Autor:</label>
    <input type="text" name="blogs[autor]" id="autor" placeholder="Autor blogs" value="<?php echo s($blogs->autor); ?>">
</fieldset>

<fieldset>
    <legend>Información General</legend>
    <label for="detalles">Descripción:</label>
            <textarea name="blogs[detalles]" id="detalles"><?php echo s($blogs->detalles) ?></textarea>

    <label for="imagen">Imagen Blogs:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="blogs[imagen]">

            <?php if ($blogs->imagen){ ?>
                <img src="../../imagenes/<?php echo $blogs->imagen?>" class="imagen-small"  alt="">
            <?php } ?> 

</fieldset>