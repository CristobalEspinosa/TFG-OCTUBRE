<?php
session_start();
include "conexion.inc.php";
$conexion = conectar();
$idproducto = $_GET['idproducto'];
$mesa = $_SESSION['mesa'];
$consulta = "select count(*) from cuenta where idproducto=$idproducto and mesa=$mesa;";
$valor = $conexion->query($consulta)->fetchColumn();
if ($valor == 0) {
    $insertar = "INSERT INTO cuenta VALUES(NULL,$mesa,1,$idproducto);";
    $conexion->query($insertar);
} else {
    $consulta2 = "select cantidad from cuenta where idproducto=$idproducto and mesa=$mesa;";
    $cantidad = $conexion->query($consulta2)->fetchColumn();
    $cantidad++;
    $modificar = "update cuenta set cantidad=$cantidad where idproducto=$idproducto and mesa=$mesa;";
    $conexion->query($modificar);
}
header('Location:index.php');
