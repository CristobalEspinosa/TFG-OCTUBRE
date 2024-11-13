<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/horario.css">
    <title>Cantina-Horario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
    <?php 
    include ("./includes/header.php"); 
    include './db/bd.inc.php'; 
    ?>

    <!-- Contenedor de reloj y horario -->
    <div class="container">
        <!-- Reloj -->
        <div class="clock" id="clock"></div>

        <!-- Horario -->
        <div class="calendar">
            <h1>Horario de la Cantina</h1>
            <?php
            $horarios = mostrarHorario();
            echo "<table border='1'>";
            echo "<tr><th>Día</th><th>Horario</th></tr>"; // Encabezados de la tabla
            foreach ($horarios as $horario) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($horario['dia']) . "</td>";
                echo "<td>" . htmlspecialchars($horario['horario']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            // Mostrar botón de edición solo para Trabajadores
            if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Trabajador') {
                echo '<button id="editButton" onclick="openModal()" class="btn btn-outline-secondary ">Editar Horario</button>';
            }
            ?>
            <div class="festivos">
                La cantina está cerrada los sábados, domingos y festivos.
            </div>
        </div>
    </div>

    <!-- Modal de edición -->
    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Trabajador'): ?>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Editar Horario</h3>
            <form action="update_schedule.php" method="post">
                <?php
                foreach ($horarios as $horario) {
                    echo "<label for='dia_" . htmlspecialchars($horario['dia']) . "'>" . htmlspecialchars($horario['dia']) . "</label>";
                    echo "<input type='text' id='dia_" . htmlspecialchars($horario['dia']) . "' name='horario[" . htmlspecialchars($horario['dia']) . "]' value='" . htmlspecialchars($horario['horario']) . "' required><br>";
                }
                ?>
                <input type="submit" value="Guardar Cambios" class="btn btn-outline-secondary">
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Div Recordatorio de recogida -->
    <div class="reminder">
        <h3>Recordatorio de Recogida para Estudiantes</h3>
        <p>Recuerda: Los bocadillos se deben recoger de 11:00 a 11:30. Gracias</p>
    </div>
    <?php include ("./includes/footer.php")?>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = timeString;
        }

        setInterval(updateClock, 1000);
        updateClock(); // initial call to display clock immediately

        function openModal() {
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
