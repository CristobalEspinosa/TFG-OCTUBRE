<?php
include("../includes/header.php");
include '../db/bd.inc.php';
?>
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/contabilidad.css">
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/footer.css">
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/header.css">
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqk8aP+0LMXbP7B6dnCFDLIi+3e3+LVHj4g1J6Q8oD3G2C9Q7p+5a" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Cantina-Contabilidad</title>

<body>
    <h1 class="titulo">Resumen de Ventas</h1>
    <a href='formularioGastos.php' class='btn btn-outline-danger'>Añadir Gasto</a>
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
                echo "<p id='totalVentas-" . $totales['idBeneficios'] . "'>Total en ventas: " . $totales['totalVentas'] . "€</p>";
                echo "<button class='btn btn-success' onclick='abrirModal(" . $totales['idBeneficios'] . ", " . $totales['totalVentas'] . ", \"" . $mes . "\")'>Modificar Totales</button>";
                echo "<button class='btn btn-danger' onclick='abrirModalGastos(" . $totales['idBeneficios'] . ")'>Ver Gastos</button>";
                echo "</div>";
                echo "</div>";
            }
             // Verificamos si se ha enviado una actualización de ventas
             if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevoTotalVentas'])) {
                $idBeneficios = $_POST['idBeneficios'];
                $nuevoTotalVentas = $_POST['nuevoTotalVentas'];
                modificarTotalVentas($idBeneficios, $nuevoTotalVentas);
                echo "<script>alert('Total de ventas actualizado exitosamente');</script>";
            }
0
            ?>
        </div>
        <div class="grafica">
            <h1>Gráfica de ventas</h1>
            <canvas id="ventasChart"></canvas>
        </div>
    </div>

    <!-- Modal para modificar el total de ventas -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Modificar Total de Ventas</h2>
            <form id="modificarTotalForm" method="POST">
                <label for="nuevoTotal">Nueva Cantidad:</label>
                <input type="number" id="nuevoTotal" name="nuevoTotalVentas" step="0.01" required>
                <input type="hidden" id="idBeneficios" name="idBeneficios">
                <input type="hidden" id="mes" name="mes">
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal para ver los gastos -->
    <div id="modalGastos" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModalGastos()">&times;</span>
            <h2>Listado de Gastos</h2>
            <div id="listaGastos"></div>
        </div>
    </div>

    <script>
        let ventasChart;

        // Inicializar el gráfico al cargar la página
        window.onload = function() {
            const ctx = document.getElementById('ventasChart').getContext('2d');
            const labels = <?php echo json_encode(array_keys($totalesPorMes)); ?>;
            const data = <?php echo json_encode(array_column($totalesPorMes, 'totalVentas')); ?>;

            ventasChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ventas',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };

        function abrirModal(idBeneficios, totalVentas, mes) {
            document.getElementById('modal').style.display = 'flex';
            document.getElementById('idBeneficios').value = idBeneficios;
            document.getElementById('nuevoTotal').value = totalVentas;
            document.getElementById('mes').value = mes;
        }

        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function abrirModalGastos(idBeneficios) {
            document.getElementById('modalGastos').style.display = 'flex';

            const xhr = new XMLHttpRequest();
            xhr.open("GET", "obtenerGastos.php?idBeneficios=" + idBeneficios, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('listaGastos').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function cerrarModalGastos() {
            document.getElementById('modalGastos').style.display = 'none';
        }

        function toggleDetalles(element) {
            const detalles = element.querySelector('.detalle');
            detalles.style.display = detalles.style.display === 'none' || detalles.style.display === '' ? 'block' : 'none';
        }
    </script>

</body>

<footer>
    <?php include("../includes/footer.php"); ?>
</footer>
</html>
