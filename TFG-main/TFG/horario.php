<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/horario.css">
    <title>Cantina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
<?php 
include ("./includes/header.php")
?>

<!-- Horario -->
    <div class="calendar">
    <h1>Horario de la Cantina</h1>
    <?php
$currentDay = date('w');
$currentDate = date('j de F');

$daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
$holidays = ['25 de diciembre', '1 de enero', '6 de enero', '29 de marzo', '1 de mayo', '15 de agosto', '12 de octubre', '1 de noviembre'];

$openingTime = '8:15';
$closingTime = '13:00';

for ($i = 0; $i < count($daysOfWeek); $i++) {
    echo '<div class="day">';
    echo '<span class="day-name">' . $daysOfWeek[$i] . '</span>';
    echo '<span class="time">' . $openingTime . ' - ' . $closingTime . '</span>';
    echo '</div>';
}

echo '<div class="festivos">';
echo 'La cantina está cerrada los sábados, domingos y festivos.';
echo '</div>';
?>
    </div>

<!-- Div Recordatorio de recogida -->
<div class="reminder">
            <h3>Recordatorio de Recogida para Estudiantes</h3>
        <p>Recuerda: Los bocadillos se deben recoger de 11:00 a 11:30. Gracias</p>
    </div>

    <?php 
include ("./includes/footer.php")
?>
</body>

</html>