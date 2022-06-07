document.addEventListener("DOMContentLoaded", function () {
  eventListeners();

  darkMode();
});

function darkMode() {
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme : dark)");
  const botonDarkMode = document.querySelector(".dark-mode-boton");

  if (prefiereDarkMode.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  botonDarkMode.addEventListener("click", onDark);
}

function onDark() {
  document.body.classList.toggle("dark-mode");
}

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");

  mobileMenu.addEventListener("click", navegacionResponsive);

  // Muestra campos condicionales
  const metodoContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"]'
  );
  metodoContacto.forEach((input) =>
    input.addEventListener("click", mostrarMetodosContacto)
  );
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  if (navegacion.classList.contains("mostrar")) {
    navegacion.classList.remove("mostrar");
  } else {
    navegacion.classList.add("mostrar");
  }
  // navegacion.classList.toggle('mostrar'); es lo mismo que el if de arriba pero es para un poco mas avanzados
}

function mostrarMetodosContacto(e) {
  const contactoDiv = document.querySelector("#contacto");

  if (e.target.value === "telefono") {
    contactoDiv.innerHTML = `<label for="telefono"></label>
        <input data-cy="input-telefono" type="tel" placeholder="Tú Teléfono" id="telefono" name="contacto[telefono]"> 
        <p>Elija la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]" required>

        <label for="hora">Hora</label>
        <input data-cy="input-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" required>`;
  } else {
    contactoDiv.innerHTML = `
      <label for="email"></label>
      <input data-cy="input-email" type="email" placeholder="Tú E-mail" id="email" name="contacto[email]" required> `;
  }
}
