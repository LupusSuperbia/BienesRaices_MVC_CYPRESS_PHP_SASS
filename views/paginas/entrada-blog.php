<article class="entrada-blog">
    <?php foreach($blogs as $blog): ?>
        <div class="imagen">
            <picture>
                <source srcset="build/img/blog1.webp" type="image/webp">
                <source srcset="build/img/blog1.jpg" type="image/jpg">
                <img src="imagenes/<?php echo $blog->imagen; ?>" alt="texto entrante" loading="lazy">
            </picture>
        </div>
        <div class="texto-entrada">

            <a href="/entrada?id=<?php echo $blog->id?>">
                <h4><?php echo $blog->titulo;?></h4>
                <p>Escritorio el <span><?php echo $blog->fecha;?></span> por: <span><?php echo $blog->autor;?></span></p>

                <p><?php echo $blog->detalles;?></p>
            </a>
        </div>
    <?php endforeach; ?>
    </article>
