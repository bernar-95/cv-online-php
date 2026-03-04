// Controla si está en modo edición
let editando = false;

// Activa o desactiva edición
function activarEdicion() {
    editando = !editando;
    document.body.classList.toggle("editando");

    const elementos = document.querySelectorAll("[contenteditable]");
    elementos.forEach(el => {
        el.contentEditable = editando;
    });
}

// Guarda datos en el servidor
function guardarDatos() {

    const datos = {
    nombre: nombre.innerHTML,
    titulo: titulo.innerHTML,
    contacto: contacto.innerHTML,
    habilidades: habilidades.innerHTML,
    aptitudes: aptitudes.innerHTML,
    conocimientos: conocimientos.innerHTML,
    perfil: perfil.innerHTML,
    experiencia: experiencia.innerHTML,
    educacion: educacion.innerHTML,
    fotoPerfil: fotoPerfil.src
    };

    fetch("guardar.php", {
        method: "POST",
        body: JSON.stringify(datos),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => res.text())
    .then(res => alert(res))
    .catch(err => console.error(err));
}

// Borra datos
function borrarDatos() {
    fetch("guardar.php", {
        method: "POST",
        body: JSON.stringify({})
    }).then(() => location.reload());
}

// Cambiar foto
function cambiarFoto(event) {
    const lector = new FileReader();
    lector.onload = function() {
        document.getElementById("fotoPerfil").src = lector.result;
    };
    lector.readAsDataURL(event.target.files[0]);
}