<?php
session_start();
include './db/bd.inc.php';

$response = ['success' => false, 'error' => ''];

try {
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'Trabajador') {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'abrir') {
                abrirCaja();
                $response['success'] = true;
            } elseif ($_GET['action'] === 'cerrar') {
                cerrarCaja();
                $response['success'] = true;
            } elseif ($_GET['action'] === 'obtenerCantidad') {
                $response['cantidad'] = obtenerCantidadActual();
                $response['success'] = true;
            } else {
                $response['error'] = 'Acción no válida';
            }
        } else {
            $response['error'] = 'No se recibió ninguna acción';
        }
    } else {
        $response['error'] = 'No tienes permisos para realizar esta acción';
    }
} catch (Exception $e) {
    $response['error'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
