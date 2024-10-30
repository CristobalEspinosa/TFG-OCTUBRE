<?php
include '../db/bd.inc.php';

if (isset($_GET['idBeneficios'])) {
    $idBeneficios = $_GET['idBeneficios'];
    $gastos = obtenerGastosPorBeneficio($idBeneficios);

    if ($gastos) {
        echo "<ul>";
        foreach ($gastos as $gasto) {
            echo "<li>" . $gasto['concepto'] . " - " . $gasto['cantidad'] . "€</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay gastos registrados para este beneficio.</p>";
    }
}
?>
