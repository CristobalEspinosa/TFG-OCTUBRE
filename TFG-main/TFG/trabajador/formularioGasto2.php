<?php 
require_once("../db/bd.inc.php");

$concepto = $_POST['concepto'];
$cantidad = $_POST['cantidad'];
$idBeneficios = $_POST['idBeneficios']; // Captura el idBeneficios

// Aquí asegúrate de que $idBeneficios no sea null
if (empty($idBeneficios)) {
    echo "<script type='text/javascript'>alert('Error: idBeneficios no puede estar vacío.');</script>";
    exit; // Detener la ejecución si el idBeneficios es inválido
}

registrarPago($concepto, $cantidad, $idBeneficios); // Usa el idBeneficios en lugar de $idTotales
echo "<script type='text/javascript'>alert('Gasto registrado correctamente.');
window.location.href = '/TFG-main/TFG/trabajador/contabilidad.php';</script>";
?>