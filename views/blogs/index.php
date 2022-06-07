<main class="contenedor seccion">
    <h1>Adminisitrador De Bienes Raices(BLOG)</h1>
    <?php
    $mensaje = mostrarNotificacion(intval($resultado));
    if ($mensaje) { ?>
        <p class="alerta exito"><?php echo s($mensaje) ?></p>
    <?php    } ?>


    <a href="/blogs/crear" class="boton boton-verde">Nuevo Blog</a>


    <h2>Blogs</h2>


    <table class="blog">
        <thead>
            <tr>

                <th>ID</th>

                <th>Titulo</th>

                <th>Autor</th>
                
                <th>Imagen</th>
                
                <th>Fecha</th>

                <th>Acciones </th>

            </tr>
        </thead>

        <tbody>
            <!--Mostrar un resultado -->
            <tr>

                <?php foreach ($blogs as $blog) : ?>

                    <td><?php echo $blog->id; ?></td>

                    <td><?php echo $blog->titulo; ?></td>
                    
                    <td><?php echo $blog->autor; ?></td>

                    <td> <img src="/imagenes/<?php echo $blog->imagen; ?>" alt="imagen" class="imagen-tabla"></td>

                    <td> <?php echo $blog->fecha; ?></td>
                    

                    <td>
                        <form method="POST" class="w-100" action="/blogs/eliminar">
                            <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                            <input type="hidden" name="tipo" value="blog">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/blogs/actualizar?id=<?php echo $blog->id ?>" class="boton-amarillo-block">Actualizar</a>

                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>