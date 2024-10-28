<?php
require_once("../db/bd.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos enviados por el formulario
    $articulo = $_POST['articulo'];
    $pvp = $_POST['pvp'];
    $precioCompra = $_POST['precioCompra'];
    $stock = $_POST['stock'];
    $idProveedor = $_POST['idProveedor'];
    $idCategoria = $_POST['idCategoria'];

  
    registrarArticulo($articulo, $pvp, $precioCompra, $stock, $idProveedor, $idCategoria);
    echo "<script type='text/javascript'>alert('Producto registrado correctamente.');
    window.location.href = '/TFG-main/TFG/trabajador/productos.php';</script>";
} 
?>
