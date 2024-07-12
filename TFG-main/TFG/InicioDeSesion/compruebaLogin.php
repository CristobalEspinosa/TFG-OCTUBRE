<?php
session_start();
require_once ("../db/bd.inc.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$user = compruebaUsuario($correo, $contrasena);
if ($user) {
    $_SESSION['hola'] = true;
    $_SESSION['idUsuario'] = $user['idUsuario'];
    $_SESSION['username'] = $user['nombre'];
    $_SESSION['apellidos'] = $user['apellidos']; 
    $_SESSION['correo'] = $correo;
    $_SESSION['tipo'] = $user['tipo'];

    if ($_SESSION['tipo'] != 'Trabajador') {
        $idUsuario = $_SESSION['idUsuario'];
        if (ultimoPedidoPagado($idUsuario)) {
            $fecha = date('Y-m-d'); 
            $hora = date('H:i:s');
            $precioPedido=0;
            $idPedido = creaPedido($idUsuario, $fecha, $hora,$precioPedido);
            $_SESSION['idPedido'] = $idPedido;
        }
    }

    header("Location: /TFG-main/TFG/index.php");
} else {
    echo "<script type='text/javascript'>alert('Usuario o contraseña incorrectos');
    window.location.href = '/TFG-main/TFG/InicioDeSesion/inicioSesion.php';</script>";
}
?>
