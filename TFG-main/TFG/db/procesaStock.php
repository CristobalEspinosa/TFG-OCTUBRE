<?php
include './bd.inc.php';
//actualizar stock
function actualizarStock($idArticulo, $nuevoStock)
{
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE articulo SET stock = :stock WHERE idArticulo = :idArticulo");
    $sql->bindParam(':stock', $nuevoStock);
    $sql->bindParam(':idArticulo', $idArticulo);
    if ($sql->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el stock']);
    }
}

function actualizarPrecio($idArticulo, $nuevoPrecio)
{
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE articulo SET pvp = :pvp WHERE idArticulo = :idArticulo");
    $sql->bindParam(':pvp', $nuevoPrecio);
    $sql->bindParam(':idArticulo', $idArticulo);
    if ($sql->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el precio']);
    }
}

// Asegúrate de que estás manejando una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodifica el cuerpo de la solicitud
    $data = $_POST; // Cambiado de json_decode(file_get_contents('php://input'), true);
    // Llama a tu función actualizarStock() o actualizarPrecio() dependiendo de los datos recibidos
    if (isset($data['nuevoStock'])) {
        actualizarStock($data['idArticulo'], $data['nuevoStock']);
    } elseif (isset($data['nuevoPrecio'])) {
        actualizarPrecio($data['idArticulo'], $data['nuevoPrecio']);
    }
}
?>
