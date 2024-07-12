<?php 
include ("../includes/header.php");
include '../db/bd.inc.php';
?>
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/contabilidad.css">
<body>
    <h1 class="titulo">Resumen de Ventas</h1>
    <?php
    // Obtener todos los totales por mes
    $totalesPorMes = obtenerTotalesPorMes();

    foreach ($totalesPorMes as $mes => $totales) {
        echo "<div class='pedido'>";
        echo "<h2 class='mes'>" . $mes . "</h2>";
        echo "<p class='detalle'>Número de pedidos: " . $totales['numPedidos'] . "</p>";
        echo "<p class='detalle'>Total en ventas: " . $totales['totalVentas'] . "€</p>";
        echo "</div>";
    }
    ?>
</body>

<?php 
include ("../includes/footer.php");
?>
</html>
