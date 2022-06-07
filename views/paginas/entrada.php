<main class="contenedor seccion contenido-centrado">  
<h1><?php echo $blogs->titulo; ?></h1>

        <p class="informacion-meta">Escrito el : <span><?php echo $blogs->fecha; ?></span> por: <span><?php echo $blogs->autor; ?></span></p>
        <picture>
            <img src="imagenes/<?php echo $blogs->imagen; ?>" alt="anuncio" loading="lazy" />
          </picture>

          <div class="resumen-propiedad">
              <!-- <p class="precio">$3.000.000</p> -->
              <!-- <ul class="iconos-caracteristicas">
                <li>
                  <img loading="lazy" src="build/img/icono_wc.svg" alt="icono" />
                  <p>3</p>
                </li>
                <li>
                  <img
                    loading="lazy"
                    src="build/img/icono_estacionamiento.svg"
                    alt="icono"
                  />
                  <p>3</p>
                </li>
                <li>
                  <img
                    loading="lazy"
                    src="build/img/icono_dormitorio.svg"
                    alt="icono"
                  />
                  <p>4</p>
                </li>
              </ul> -->
              <p><?php echo $blogs->detalles; ?></p>
          </div>
    </main>