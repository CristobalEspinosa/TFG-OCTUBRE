<?php
function conectar() {
$conexion=   $host = "localhost";
$basedatos = "tfg";
$usuario = "root";
$password = "";

return new PDO("mysql:host=$host;dbname=$basedatos", $usuario, $password);
}


function getCategorias() {
    $sql="SELECT * FROM categoria";
    $conexion=conectar();
    $datos=$conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $datos;


}
?>