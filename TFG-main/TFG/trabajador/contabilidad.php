<?php 
include ("../includes/header.php");
include '../db/bd.inc.php';
?>
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/contabilidad.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>
<h1 class="titulo">Resumen de Ventas</h1>
    <div class="contenedor">
        <div class="meses">
        <h1>Meses:</h1>
 
        <?php
        $totalesPorMes = obtenerTotalesPorMes();

        foreach ($totalesPorMes as $mes => $totales) {
            echo "<div class='pedido' onclick='toggleDetalles(this)'>";
            echo "<h2 class='mes'>" . $mes . "</h2>";
            echo "<div class='detalle'>";
            echo "<p>Número de pedidos: " . $totales['numPedidos'] . "</p>";
            echo "<p>Total en ventas: " . $totales['totalVentas'] . "€</p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
        <div class="grafica">
            <h1>Gráfica de ventas</h1>
            <canvas id="ventasChart"></canvas>
        </div>
    </div>

    <script>
        // Datos de ejemplo, reemplaza esto con los datos reales de PHP
        var labels = <?php echo json_encode(array_keys($totalesPorMes)); ?>;
        var numPedidos = <?php echo json_encode(array_column($totalesPorMes, 'numPedidos')); ?>;
        var totalVentas = <?php echo json_encode(array_column($totalesPorMes, 'totalVentas')); ?>;

        var ctx = document.getElementById('ventasChart').getContext('2d');
        var ventasChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Pedidos',
                    data: numPedidos,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Total en Ventas (€)',
                    data: totalVentas,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

    <script>
        function toggleDetalles(element) {
            const detalles = element.querySelector('.detalle');
            if (detalles.style.display === 'none' || detalles.style.display === '') {
                detalles.style.display = 'block';
            } else {
                detalles.style.display = 'none';
            }
        }
    </script>
</body>
<footer>

    <?php 
include ("../includes/footer.php");
?>
</footer>
</html>
