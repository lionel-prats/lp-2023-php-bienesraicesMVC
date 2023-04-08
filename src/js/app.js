// evento que se ejecuta luego de que haya cargado el HTML, el CSS y el JS
document.addEventListener("DOMContentLoaded", () => {
    eventListeners();
    darkMode();
})

// modo oscuro del sitio
function darkMode() {

    // detecta si en las preferencias de sistema del cliente esta activado el modo oscuro, y en ese caso activa el modo oscuro por defecto
    // tambien reacciona en tiempo real si el usuario cambia las preferencias del sistema
    /* const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    }); */
    
    // detecta si en las preferencias de sistema del cliente esta activado el modo oscuro, y en ese caso activa el modo oscuro por defecto
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    prefiereDarkMode.matches? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');
    
    // tambien reacciona en tiempo real si el usuario cambia las preferencias del sistema
    prefiereDarkMode.addEventListener("change", () => {
        prefiereDarkMode.matches? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');
    })

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
    });
}

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", navegacionResponsive);
    
    // mostrar campos condicionales en el form de contacto
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => {
        input.addEventListener("click", mostrarMetodosContacto);
    });
}

function navegacionResponsive() {
    const navegacion = document.querySelector(".navegacion");
    navegacion.classList.toggle("mostrar");
}

// inyectar codigo HTML desde JS - version Lio
/*
function mostrarMetodosContacto(e) {

    const contactoDiv = document.querySelector("#contacto");
    contactoDiv.innerHTML = "";

    const labelContacto = document.createElement("label");
    const inputContacto = document.createElement("input");

    const fragment = document.createDocumentFragment();

    if(e.target.value === "telefono") {

        // label & input contacto (en este caso telefono)
        labelContacto.textContent = "Teléfono";
        labelContacto.setAttribute("for", "telefono");

        inputContacto.setAttribute("type", "number");
        inputContacto.setAttribute("placeholder", "12345678[12]");
        inputContacto.setAttribute("id", "telefono");
        inputContacto.setAttribute("name", "contacto[telefono]");
        inputContacto.setAttribute("required", true);

        // label & input fecha
        const labelFecha = document.createElement("label");
        const inputFecha = document.createElement("input");

        labelFecha.textContent = "Fecha";
        labelFecha.setAttribute("for", "fecha");

        inputFecha.setAttribute("type", "date");
        inputFecha.setAttribute("id", "fecha");
        inputFecha.setAttribute("name", "contacto[fecha]");
        //inputFecha.setAttribute("required", true);

        // label & input hora
        const labelHora = document.createElement("label");
        const inputHora = document.createElement("input");

        labelHora.textContent = "Hora";
        labelHora.setAttribute("for", "hora");

        inputHora.setAttribute("type", "time");
        inputHora.setAttribute("id", "hora");
        inputHora.setAttribute("name", "contacto[hora]");
        inputHora.setAttribute("min", "09:00");
        inputHora.setAttribute("max", "18:00");
        //inputHora.setAttribute("required", true);
        
        fragment.appendChild(labelContacto);
        fragment.appendChild(inputContacto);
        fragment.appendChild(labelFecha);
        fragment.appendChild(inputFecha);
        fragment.appendChild(labelHora);
        fragment.appendChild(inputHora);
    
    } else if (e.target.value === "email") {

        // label & input contacto (en este caso email)
        labelContacto.textContent = "E-mail";
        labelContacto.setAttribute("for", "email");

        inputContacto.setAttribute("type", "email");
        inputContacto.setAttribute("placeholder", "correo@correo.com");
        inputContacto.setAttribute("id", "email");
        inputContacto.setAttribute("name", "contacto[email]");
        inputContacto.setAttribute("required", true);

        fragment.appendChild(labelContacto);
        fragment.appendChild(inputContacto);
    } 

    contactoDiv.appendChild(fragment);

    contactoDiv.style.marginTop = "2rem";
}
*/

// inyectar codigo HTML desde JS - version Profesor
function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector("#contacto");
    if(e.target.value === "telefono") {
        contactoDiv.innerHTML = `
            <label for="telefono">Teléfono de contacto</label>
            <input type="number" placeholder="solo números (8 a 10 dígitos)" id="telefono" name="contacto[telefono]">
            <p>Indique fecha y la hora para ser contactado</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">
            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else if (e.target.value === "email") {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="correo@correo.com" id="email" name="contacto[email]" required>
        `;
    } 
    contactoDiv.style.marginTop = "2rem";
}






/* 
<label for="telefono">Teléfono</label>
<input type="number" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

<label for="email">E-mail</label>
<input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>

<label for="fecha">Fecha</label>
<input type="date" id="fecha" name="contacto[fecha]">

<label for="hora">Hora</label>
<input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">

*/