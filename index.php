<?php
// Detectamos si estamos en modo PDF
$modoPDF = isset($_GET['pdf']);

// Archivo donde se guardan los datos
$archivoDatos = "datos.json";

// Valores por defecto
$datos = [
    "nombre" => "",
    "titulo" => "",
    "contacto" => "",
    "habilidades" => "",
    "aptitudes" => "",
    "conocimientos" => "",
    "perfil" => "",
    "experiencia" => "",
    "educacion" => "",
    "fotoPerfil" => "https://via.placeholder.com/150"
];

// Si existe datos.json, lo leemos
if (file_exists($archivoDatos)) {
    $contenido = file_get_contents($archivoDatos);
    $json = json_decode($contenido, true);

    if ($json) {
        $datos = array_merge($datos, $json);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CV - Berna Hermosillo</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="contenedor">

<?php if(!$modoPDF): ?>
<div class="barra-superior">
    <button onclick="activarEdicion()">Activar Edición</button>
    <button onclick="guardarDatos()">Guardar</button>
    <button onclick="window.open('?pdf=1')">Descargar PDF</button>
    <button onclick="borrarDatos()">Borrar Datos</button>
</div>
<?php endif; ?>

<!-- ENCABEZADO -->
<header class="encabezado">

    <div class="foto-container">
        <img id="fotoPerfil" src="<?php echo $datos["fotoPerfil"]; ?>" alt="Foto de perfil">

        <?php if(!$modoPDF): ?>
        <input type="file" accept="image/*" onchange="cambiarFoto(event)">
        <?php endif; ?>
    </div>

    <div class="texto-encabezado">
        <h1 id="nombre" contenteditable="false">
            <?php echo $datos["nombre"]; ?>
        </h1>

        <p id="titulo" contenteditable="false">
            <?php echo $datos["titulo"]; ?>
        </p>
    </div>

</header>

<!-- CONTENIDO -->
<div class="contenido-principal">

    <div class="columna-izquierda">

        <section class="tarjeta">
            <h2>Contacto</h2>
            <p id="contacto" contenteditable="false">
                <?php echo $datos["contacto"]; ?>
            </p>
        </section>

        <section class="tarjeta">
            <h2>Habilidades</h2>
            <ul id="habilidades" contenteditable="false">
                <?php echo $datos["habilidades"]; ?>
            </ul>

            <h2>Aptitudes</h2>
            <ul id="aptitudes" contenteditable="false">
            <?php echo $datos["aptitudes"]; ?>
            </ul>

            <h2>Conocimientos / Certificaciones</h2>
            <ul id="conocimientos" contenteditable="false">
            <?php echo $datos["conocimientos"]; ?>
            </ul>
        </section>

    </div>

    <div class="columna-derecha">

        <section class="tarjeta">
            <h2>Perfil Profesional</h2>
            <p id="perfil" contenteditable="false">
                <?php echo $datos["perfil"]; ?>
            </p>
        </section>

        <section class="tarjeta">
            <h2>Experiencia</h2>
            <div id="experiencia" contenteditable="false">
                <?php echo $datos["experiencia"]; ?>
            </div>
        </section>

        <section class="tarjeta">
            <h2>Educación</h2>
            <div id="educacion" contenteditable="false">
                <?php echo $datos["educacion"]; ?>
            </div>
        </section>

    </div>

</div>

</div>

<?php if(!$modoPDF): ?>
<script src="datos.js"></script>
<?php else: ?>
<script>
window.onload = function() {
    window.print();
};
</script>
<?php endif; ?>

</body>
</html>