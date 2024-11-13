<?php
require_once("../db/bd.inc.php");
?>


<link rel="stylesheet" href="/TFG-main/TFG/CSS/inicioSesion.css">
<title>Cantina-RegistroTrabajador</title>
<header>
    <a href="/TFG-main/TFG/trabajador/usuarios.php" class="atras">Volver atrás</a>
</header>
<div class="tresd">
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
<spline-viewer url="https://prod.spline.design/B-GP9rfE-bYhHGvs/scene.splinecode"></spline-viewer>
</div>
<form action="registro2.php" method="POST" class="formulario">
    <label for="nombre" class="etiqueta">Nombre</label>
    <input type="text" id="nombre" name="nombre" class="entrada" placeholder="Ej: Pepe">
    <br>
    <label for="apellido" class="etiqueta">Apellido</label>
    <input type="text" id="apellidos" name="apellidos" class="entrada" placeholder="Ej: Ruiz">
    <br>
    <label for="tipo" class="etiqueta"></label>
    <select id="tipo" name="tipo" class="entrada">
        <option value="Trabajador">Trabajador</option>
        <option value="Profesor">Profesor</option>
        <option value="Alumno">Alumno</option>
    </select>
    <br>
    <label for="correo" class="etiqueta">Correo</label>
    <input type="text" id="correo" name="correo" class="entrada" placeholder="Ej: pepe123@gmail.com">
    <br>
    <label for="password" class="etiqueta">Contraseña</label>
    <input type="password" id="password" name="password" class="entrada" placeholder="Contraseña">
    <br>
    <input type="submit" value="Registrarse" class="boton">
</form>