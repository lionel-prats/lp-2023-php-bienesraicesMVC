<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">
    <div class="resumen-propiedad">
        <p class="precio">USD <?php echo number_format($propiedad->precio, 0, ",", ".")?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>    
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion ?></p>
    </div>
    <a href="/propiedades" class="boton boton-amarillo">Ver todas</a>
</main>