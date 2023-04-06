<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <?php foreach ($errores as $key => $error): ?>
        <div class="alerta error">
            <?php echo $error; ?> 
        </div>
    <?php endforeach ?>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <form class="formulario" method="POST" action="/vendedores/crear"> 
        <?php include /* __DIR__ . "/ */ "formulario.php"; ?>
        <input type="submit" value="Registrar vendedor" class="boton boton-verde">
    </form>
</main>