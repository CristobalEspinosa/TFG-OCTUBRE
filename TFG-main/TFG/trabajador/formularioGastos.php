<?php
require_once("../db/bd.inc.php");
// Obtener los beneficios 
$beneficios = obtenerBeneficios();
?>

<link rel="stylesheet" href="/TFG-main/TFG/CSS/inicioSesion.css">
<header>
    <a href="/TFG-main/TFG/trabajador/contabilidad.php" class="atras">Volver atrás</a>
</header>

<div class="tresd">
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
<spline-viewer url="https://prod.spline.design/B-GP9rfE-bYhHGvs/scene.splinecode"></spline-viewer>
</div>
<form action="formularioGasto2.php" method="POST" class="formulario">
    <label for="concepto" class="etiqueta">Concepto</label>
    <input type="text" id="concepto" name="concepto" class="entrada" placeholder="Ej: Luz">
    <br>
    <label for="cantidad" class="etiqueta">Cantidad</label>
    <input type="number" id="cantidad" name="cantidad" class="entrada" placeholder="Ej: 12.7">
    <br>
    <select id="idBeneficios" name="idBeneficios" class="entrada"> 
        <?php foreach ($beneficios as $beneficio) { 
            echo '<option value="' . $beneficio['idBeneficios'] . '">' . $beneficio['mes'] . '</option>'; } 
            ?> 
            </select>
    <input type="submit" value="Añadir Gasto" class="boton">
</form>
