<main class="contenedor seccion">
    <h2 data-cy="heading-nosotros">Más Sobre Nosotros </h2>

    <?php include 'iconos.php';?>
</main>

<section class="seccion contenedor" >
    <h2 data-cy="seccion-propiedades" >Casas y depas en venta</h2>

    <?php
    include 'listados.php';
    ?>

    <div class="alinear-derecha ">
        <a href="/propiedades" class="boton-verde" data-cy="todas-propiedades">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto" data-cy="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>

    <p>Llena el formulario de conctacto y un asesor se pondría en contacto contigo</p>
    <a href="/contacto" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>

        <?php include 'entrada-blog.php'?>

    </section>

    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El Personal se comporto de una excelente manera con una muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas
                <p>- Agus Samperi</p>
            </blockquote>
        </div>
    </section>
</div>