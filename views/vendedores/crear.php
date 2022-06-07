<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/vendedores/crear" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include 'formulario.php';?>
        <input type="submit" value="Registrar Vendedores" class="boton boton-verde" name="" id="">
    </form>
</main>