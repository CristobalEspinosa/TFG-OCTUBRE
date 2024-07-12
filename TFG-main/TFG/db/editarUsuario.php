<?php
include 'bd.inc.php';

if(isset($_POST['id'])) {
    $idUsuario = $_POST['id']; 

    // Llama a la función para obtener los datos del usuario
    $usuario = obtenerUsuarioPorId($idUsuario);

    if ($usuario) {
        echo json_encode($usuario); 
    } else {
        echo "No se pudo obtener los datos del usuario";
    }
} else {
    echo "No se recibió ningún ID de usuario"; 
}
?>
