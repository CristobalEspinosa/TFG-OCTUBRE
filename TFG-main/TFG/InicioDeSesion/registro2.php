<?php
require_once ("../db/bd.inc.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$tipo = $_POST['tipo'];
$correo = $_POST['correo'];
$password = $_POST['password'];


$hashed_password = hash('sha256', $password);

registrarse($nombre, $apellidos, $correo, $hashed_password, $tipo);
echo "<script type='text/javascript'>alert('Usuario registrado correctamente.');
window.location.href = '/TFG-main/TFG/InicioDeSesion/inicioSesion.php';</script>";
?>

