<main class="contenedor seccion">
    <h1>Crear nuevo Blog</h1>
    <a href="/blogs/index" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/blogs/crear" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include 'formulario.php';?>
        <input type="submit" value="Subir Blog" class="boton boton-verde" name="" id="">
    </form>
</main>