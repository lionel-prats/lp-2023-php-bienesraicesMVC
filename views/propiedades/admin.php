<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
        
    <?php 
        if($result) {
            $mensaje = mostrarNotificacion(intval($result));
            if(!is_null($mensaje)) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php }
        }
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
    <!-- 
    BOTONES PARA PRUEBAS DE INYECCION SQL (APUNTAN A ARCHIVOS DENTRO DE /admin/propiedades)
    <a href="/bienesraices/admin/propiedades/inyeccion.php" class="boton boton-amarillo">Buscar Vendedor</a>
    <a href="/bienesraices/admin/propiedades/inyeccion2.php" class="boton boton-verde">Login Devstagram</a>
    <a href="/bienesraices/admin/propiedades/inyeccion3.php" class="boton boton-amarillo">Baja de Usuario</a>
    -->
    <h2>Propiedades</h2>
    
    <table class="propiedades">
        <thead>
            <th>ID</th>
            <th>Título</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="imagen propiedad"> 
                    </td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>

                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>

                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100 lh-default" value="Eliminar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido;; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td> 
                    <td>

                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>

                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block w-100 lh-default" value="Eliminar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>