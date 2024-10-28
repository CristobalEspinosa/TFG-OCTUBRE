<?php
require_once("../db/bd.inc.php");
?>


<link rel="stylesheet" href="/TFG-main/TFG/CSS/inicioSesion.css">
<header>
    <a href="/TFG-main/TFG/trabajador/productos.php" class="atras">Volver atrás</a>
</header>
<div class="tresd">
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
<spline-viewer url="https://prod.spline.design/B-GP9rfE-bYhHGvs/scene.splinecode"></spline-viewer>
</div>
<form action="/TFG-MAIN/TFG/trabajador/procesaArticulo.php" method="POST" class="formulario">
    <label for="articulo" class="etiqueta">Nombre del Artículo</label>
    <input type="text" id="articulo" name="articulo" class="entrada" placeholder="Ej: Lámpara" required>
    <br>

    <label for="pvp" class="etiqueta">PVP</label>
    <input type="number" step="0.01" id="pvp" name="pvp" class="entrada" placeholder="Ej: 50.99" required>
    <br>

    <label for="stock" class="etiqueta">Stock</label>
    <input type="number" id="stock" name="stock" class="entrada" placeholder="Ej: 100" required>
    <br>

    <!-- Lista desplegable de Proveedores -->
    <label for="proveedor" class="etiqueta">Proveedor</label>
    <select id="proveedor" name="idProveedor" class="entrada" required>
        <option value="1">Panadería Juana</option>
        <option value="2">Consum</option>
        <option value="3">Chucherías Fini</option>
        <option value="4">Cafés Salzillo</option>
        <option value="5">Pizzería Verona</option>
    </select>
    <br>

    <!-- Lista desplegable de Categorías -->
    <label for="categoria" class="etiqueta">Categoría</label>
    <select id="categoria" name="idCategoria" class="entrada" required>
        <option value="1">Bocadillos Enteros</option>
        <option value="2">Cafés</option>
        <option value="3">Pizzas</option>
        <option value="4">Tostadas</option>
        <option value="5">Chicles</option>
        <option value="6">Refrescos</option>
        <option value="7">Bolsas</option>
        <option value="8">Empanadillas</option>
        <option value="9">Bocadillos Medios</option>
        <option value="10">Infusiones</option>
    </select>
    <br>

    <input type="submit" value="Registrar Artículo" class="boton">
</form>