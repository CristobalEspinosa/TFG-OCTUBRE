<?php
include './db/bd.inc.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Trabajador') {
    $newHorario = $_POST['horario'];

    foreach ($newHorario as $dia => $horario) {
        if (!actualizaHorario($dia, $horario)) {
            // Manejar error si la actualización falla
            echo "Error al actualizar el horario para el día: " . htmlspecialchars($dia);
            exit();
        }
    }

    // Redirige de nuevo a la página de horario después de guardar los cambios
    header('Location: horario.php');
    exit();
}
?>