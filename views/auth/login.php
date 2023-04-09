<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach ($errors as $key => $error): ?>
        <div class="alerta error contenido-centrado mx-auto">
            <?php echo $error; ?> 
        </div>
    <?php endforeach ?>
    <form method="POST" class="formulario form-login" novalidate>
        <fieldset>
            
            <legend>Credenciales</legend>

            <label for="email">Email</label>
            <input type="email" placeholder="Tu email" id="email" name="email" value="<?php echo $email ?>" required>
            
            <label for="password">Password</label>
            <input class="input-pass" type="password" placeholder="Tu password" id="password" name="password" required>
            
            <input id="checkbox" type="checkbox" onclick="showPassword()">
            <label for="checkbox">Mostrar Contraseña</label>

        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton-verde">
    </form>
</main>
<script>
    function showPassword() {
        let inputPassword = document.getElementById("password");
        if (inputPassword.type === "password") {
            inputPassword.type = "text";
        } else {
            inputPassword.type = "password";
        }
    }
</script>