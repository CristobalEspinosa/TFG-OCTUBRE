<?php
require_once("../db/bd.inc.php");
?>

<link rel="stylesheet" href="/TFG-main/TFG/CSS/inicioSesion.css">
<title>Cantina-RegistroUsuario</title>
<header>
    <a href="/TFG-main/TFG/index.php" class="atras">Volver atrás</a>
</header>
<div class="tresd">
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
<spline-viewer url="https://prod.spline.design/B-GP9rfE-bYhHGvs/scene.splinecode"></spline-viewer>
</div>
<form action="registro2.php" method="POST" class="formulario" onsubmit="return validarContrasena() && validarCorreo();">
    <label for="nombre" class="etiqueta">Nombre</label>
    <input type="text" id="nombre" name="nombre" class="entrada" placeholder="Ej: Pepe">
    <br>
    <label for="apellido" class="etiqueta">Apellidos</label>
    <input type="text" id="apellidos" name="apellidos" class="entrada" placeholder="Ej: Ruiz">
    <br>
    <label for="tipo" class="etiqueta"></label>
    <select id="tipo" name="tipo" class="entrada">
        <option value="Alumno">Alumno</option>
        <option value="Profesor">Profesor</option>
    </select>
    <br>
    <label for="correo" class="etiqueta">Correo Murciaeduca</label>
    <input type="text" id="correo" name="correo" class="entrada" placeholder="Ej: 12345678@alu.murciaeduca.es">
    <br>
    <label for="password" class="etiqueta">Contraseña</label>
    <input type="password" id="password" name="password" class="entrada" placeholder="Contraseña">
    <input type="checkbox" onclick="mostrarContrasena()"> Mostrar Contraseña
    <br>
    <input type="submit" value="Registrarse" class="boton">
</form>

<script>
 function validarContrasena() {
    var contrasena = document.getElementById("password").value;
    var regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#?&]).{8,}$/;

    if (regex.test(contrasena)) {
        return true;
    } else {
        alert("La contraseña debe tener al menos 8 caracteres, un número, una letra mayúscula y un carácter especial.");
        return false;
    }
}


    function validarCorreo() {
        var correo = document.getElementById("correo").value;
        var regex = /^[\w-]+(\.[\w-]+)*@((alu\.murciaeduca\.es)|(murciaeduca\.es))$/;

        if (regex.test(correo)) {
            return true;
        } else {
            alert("Utiliza tu correo murciaeduca por favor.");
            return false;
        }
    }

    function mostrarContrasena() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
