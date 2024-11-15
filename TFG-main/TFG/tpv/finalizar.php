<?php
session_start();
include "conexion.inc.php";
$conexion=conectar();
$mesa=$_SESSION['mesa'];
$total=$_GET['total'];
$fecha=date('Y-m-d');
$hora=date('H:i');
$insertar="insert into caja2 values(NULL,$mesa,'$fecha','$hora',$total);";
$conexion->query($insertar);
$borrar="delete from cuenta where mesa=$mesa;";
$conexion->query($borrar);
header('Location:index.php');
?>
