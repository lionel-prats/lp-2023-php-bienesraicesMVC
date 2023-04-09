<main class="contenedor seccion">
  
    <?php if($mensaje){ ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php } ?>
    <?php if(!empty($errors)){ ?>
        <div class="alerta error">Se detectaron uno o más errores. Por favor, revise el formulario.</div>
    <?php } ?>

    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" method="POST" action="/contacto" novalidate>
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required value="<?php echo isset($response->nombre) ? $response->nombre : ""; ?>">
            <?php if(isset($errors["nombre"])) { ?>
                <small class="err-msg"><?php echo $errors["nombre"]; ?></small>
            <?php } ?>


            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required><?php echo isset($response->mensaje) ? $response->mensaje : ""; ?></textarea>
            <?php if(isset($errors["mensaje"])) { ?>
                <small class="err-msg"><?php echo $errors["mensaje"]; ?></small>
            <?php } ?>
        </fieldset>
        
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            
            <label for="opciones">Vende o compra</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option 
                    value="Compra"
                    <?php echo (isset($response->tipo) and $response->tipo === "Compra") ? "selected" : ""; ?>
                >
                    Compra
                </option>
                <option 
                    value="Vende"
                    <?php echo (isset($response->tipo) and $response->tipo === "Vende") ? "selected" : ""; ?>
                >
                    Vende
                </option>
            </select>
            <?php if(isset($errors["tipo"])) { ?>
                <small class="err-msg"><?php echo $errors["tipo"]; ?></small>
            <?php } ?>
            
            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required value="<?php echo isset($response->precio) ? $response->precio : ""; ?>">
            <?php if(isset($errors["precio"])) { ?>
                <small class="err-msg"><?php echo $errors["precio"]; ?></small>
            <?php } ?>
        </fieldset>
        
        <fieldset>
            <legend>Información de contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input 
                    type="radio" 
                    value="telefono" 
                    id="contactar-telefono" 
                    name="contacto[contacto]" 
                    required
                    <?php echo (isset($response->contacto) and $response->contacto === "telefono") ? "checked" : ""; ?>    
                >
                
                <label for="contactar-email">E-mail</label>
                <input 
                    type="radio" 
                    value="email" 
                    id="contactar-email" 
                    name="contacto[contacto]" 
                    required
                    <?php echo (isset($response->contacto) and $response->contacto === "email") ? "checked" : ""; ?>       
                >
            </div>
            <?php if(isset($errors["contacto"])) { ?>
                <small class="err-msg err-msg--contact"><?php echo $errors["contacto"]; ?></small>
            <?php } ?> 
            

            <!-- campos condicionales inyectados desde app.js - VIDEO 428 -->
            <!-- <div id="contacto"></div> -->

            <div 
                class="
                    contacto-condicional
                    <?php echo (isset($response->contacto) and $response->contacto === "telefono") ? "phone-value" : ""; ?>
                "
            >
                <label for="telefono">Teléfono de contacto</label>
                <input 
                    type="number" 
                    placeholder="solo números (8 a 10 dígitos)" 
                    id="telefono" 
                    name="contacto[telefono]"
                    value="<?php echo isset($response->telefono) ? $response->telefono : ""; ?>"
                >
                <?php if(isset($errors["telefono"])) { ?>
                    <small class="err-msg"><?php echo $errors["telefono"]; ?></small>
                <?php } ?>
                <p>Indique fecha y la hora para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="contacto[fecha]" value="<?php echo isset($response->fecha) ? $response->fecha : ""; ?>">
                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" value="<?php echo isset($response->hora) ? $response->hora : ""; ?>">
            </div>
            <div 
                class="
                    contacto-condicional
                    <?php echo (isset($response->contacto) and $response->contacto === "email") ? "email-value" : ""; ?>
                "
            >
                <label for="email">E-mail</label>
                <input 
                    type="email" 
                    placeholder="correo@correo.com" 
                    id="email" 
                    name="contacto[email]" 
                    required
                    value="<?php echo isset($response->email) ? $response->email : ""; ?>"
                >
                <?php if(isset($errors["email"])) { ?>
                    <small class="err-msg"><?php echo $errors["email"]; ?></small>
                <?php } ?>
            </div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form> 
</main>