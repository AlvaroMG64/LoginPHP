// Validación front-end de usuario y contraseña
document.querySelector("form").addEventListener("submit", function (e) {
    const usuario = document.getElementById("identificador").value.trim();
    const password = document.getElementById("password").value.trim();
    const alertContainer = document.getElementById("formAlert");

    // Si ya existe un alert previo, lo eliminamos
    if (alertContainer) {
        alertContainer.remove();
    }

    // Usuario: letras, números o guión bajo, entre 8 y 15 caracteres
    const usuarioRegex = /^[A-Za-z0-9_]{8,15}$/;

    // Contraseña: 8-15 caracteres, mayúscula, minúscula, número, símbolo permitido
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%&*?-])[A-Za-z\d!@#$%&*?-]{8,15}$/;

    let mensaje = "";

    if (!usuarioRegex.test(usuario)) {
        mensaje = "Usuario debe tener entre 8 y 15 caracteres (letras, números o _).";
    } else if (!passwordRegex.test(password)) {
        mensaje = "Contraseña debe tener: mayúscula, minúscula, número y un símbolo permitido (!@#$%&*?-).";
    }

    if (mensaje) {
        e.preventDefault();

        // Crear un div de alerta Bootstrap y añadirlo al principio del formulario
        const alertDiv = document.createElement("div");
        alertDiv.id = "formAlert";
        alertDiv.className = "alert alert-danger";
        alertDiv.role = "alert";
        alertDiv.innerText = mensaje;

        const form = document.querySelector("form");
        form.prepend(alertDiv);
    }
});