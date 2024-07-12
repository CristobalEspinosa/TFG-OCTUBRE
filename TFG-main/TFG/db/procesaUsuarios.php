<?php
include 'bd.inc.php';

if(isset($_POST['id'])) {
    $idUsuario = $_POST['id']; 

    if(isset($_POST['nombre']) || isset($_POST['apellidos']) || isset($_POST['correo']) || isset($_POST['tipo']) || isset($_POST['password'])) {
        // Si se envió al menos uno de estos campos, entonces se está editando el usuario
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
        $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        // Llama a la función para editar el usuario
        $resultado = editarUsuarioActual($idUsuario, $nombre, $apellidos, $correo, $tipo, $password);

        if ($resultado) {
            echo "1"; 
        } else {
            echo "Usuario editado correctamente";
        }
    } else {
        // Si no se envió ninguno de estos campos, entonces se está eliminando el usuario
        $resultado = eliminarUsuarioActual($idUsuario);

        if ($resultado) {
            echo "1"; 
        } else {
            echo "Usuario eliminado correctamente";
        }
    }
} else {
    echo "No se recibió ningún ID de usuario"; 
}
?>
