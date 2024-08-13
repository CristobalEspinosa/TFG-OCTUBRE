<?php

/*Conectarse a la bbdd*/
function conectar() {
    try {
        $host = "localhost";
        $basedatos = "tfg";
        $usuario = "root";
        $password = "";
        
        return new PDO("mysql:host=$host;dbname=$basedatos", $usuario, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*Registrar nuevo usuario*/
function registrarse( $nombre, $apellidos, $correo, $contrasena, $tipo) {
    $conexion = conectar();
    $sql = $conexion->prepare("INSERT INTO usuario (nombre, apellidos, correo, contrasena, tipo) VALUES (:nombre, :apellidos, :correo, :contrasena, :tipo)");
    $sql->bindValue(':nombre', $nombre);
    $sql->bindValue(':apellidos', $apellidos);
    $sql->bindValue(':correo', $correo);
    $sql->bindValue(':contrasena', $contrasena);
    $sql->bindValue(':tipo', $tipo);
    $sql->execute();
}
/*Eliminar usuario actual*/
function eliminarUsuarioActual($idUsuario) {
    $conexion = conectar();
    $sql = $conexion->prepare("DELETE FROM usuario WHERE idUsuario = :idUsuario");
    $sql->bindValue(':idUsuario', $idUsuario);
    $sql->execute();
}


/*Comprueba si el usuario está en la bbdd*/
function compruebaUsuario($correo, $contrasena) {
    $conexion = conectar(); 
    $sql = $conexion->prepare("SELECT * FROM usuario WHERE correo=:correo AND contrasena=:contrasena");
    $sql->bindValue(':correo', $correo);
    $sql->bindValue(':contrasena', $contrasena);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return $user;
    } else {
        return false;
    }
}


//CAMBIAR ESTADO PARA SABER SI ESTA PAGADO Y/O REALIZADO Y/O SIENDO REALIZADO
function marcarComoRealizado($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET realizado=1 ,  siendoRealizado=0 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();

    // //ENVIAR UN EMAIL, NO SE PUEDE YA QUE NECESITA UN SERVIDOR SMTP
    // $sql = $conexion->prepare("SELECT correo FROM usuario INNER JOIN pedido ON usuario.idUsuario = pedido.idUsuario WHERE pedido.idPedido=:idPedido");
    // $sql->bindParam(':idPedido', $idPedido);
    // $sql->execute();
    // $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    // $emailUsuario = $usuario['correo'];
    // // Define el asunto y el mensaje del correo
    // $asunto = "Pedido marcado como realizado";
    // $mensaje = "Tu pedido con ID $idPedido ha sido realizado y listo para la recogida";
    // $cabeceras = 'From: cantina@riberaMolinos.com' . "\r\n" .
    //              'Reply-To: cantina@riberaMolinos.com' . "\r\n" .
    //              'X-Mailer: PHP/' . phpversion();

    // // Envía el correo
    // if(mail($emailUsuario, $asunto, $mensaje, $cabeceras)) {
    //     echo "Correo enviado con éxito a $emailUsuario";
    // } else {
    //     echo "El envío del correo a $emailUsuario ha fallado";
    // }
}

function marcarComoSiendoRealizado($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET siendoRealizado=1 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
}
function marcarComoPagado($idPedido) {
    $conexion = conectar();

    // Obtiene el precio del pedido
    $sqlPrecio = $conexion->prepare("SELECT precioPedido FROM pedido WHERE idPedido=:idPedido");
    $sqlPrecio->bindParam(':idPedido', $idPedido);
    $sqlPrecio->execute();
    $precio = $sqlPrecio->fetch(PDO::FETCH_ASSOC)['precioPedido'];

    // Marca el pedido como pagado
    $sql = $conexion->prepare("UPDATE pedido SET pagado=1 , realizado=0 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();

    // Obtener el mes actual
    $fecha = new DateTime();
    $mes = $fecha->format('Y-m');

    // Actualizar los totales
    actualizarTotales($mes, $precio, 1);
}

function eliminarPedido($idPedido) {
    $conexion = conectar();
    
    $sqlLinea = $conexion->prepare("DELETE FROM `pedido-linea` WHERE idPedido=:idPedido");
    $sqlLinea->bindParam(':idPedido', $idPedido);
    $sqlLinea->execute();

    // Luego, elimina el pedido
    $sqlPedido = $conexion->prepare("DELETE FROM pedido WHERE idPedido=:idPedido");
    $sqlPedido->bindParam(':idPedido', $idPedido);
    $sqlPedido->execute();
}

function marcarComoNoRealizado($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET realizado=0 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
}
function marcarComoSiendoNoRealizado($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET siendoRealizado=0 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
}
//poner como finalizado o no finalizado el pedido en la cesta
function finalizarPedidoConHora($idPedido, $horaRecogida) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET finalizado=1, horaRecogida=:horaRecogida WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->bindParam(':horaRecogida', $horaRecogida);
    $sql->execute();

    if ($_POST['action'] == 'finalizar') {
        $idPedido = $_POST['idPedido'];
        $horaRecogida = $_POST['horaRecogida']; // Asegúrate de validar y sanear este valor
        finalizarPedidoConHora($idPedido, $horaRecogida);
    }
}



function marcarComoNoFinalizado($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET finalizado=0 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
    
    if ($_POST['action'] == 'finalizar') {
        $idPedido = $_POST['idPedido'];
        marcarComoNoFinalizado($idPedido);
    }
}



function marcarComoNoPagado($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET pagado=0 , realizado=1 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
}

//FUNCION PARA INSERTAR UNA LINEA PEDIDO
function actualizarStockPedido($idArticulo, $cantidad) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE articulo SET stock = stock - :cantidad WHERE idArticulo = :idArticulo");
    $sql->bindParam(':cantidad', $cantidad);
    $sql->bindParam(':idArticulo', $idArticulo);
    $sql->execute();
}

function insertaPedidoLinea($idArticulo, $cantidad, $idPedido,$extra,$precioLinea) {
    $conexion = conectar();
    $sql = $conexion->prepare("INSERT INTO `pedido-linea` (idPedidoLinea, idArticulo, cantidad, idPedido, extra, precioLinea) VALUES (NULL, :idArticulo, :cantidad, :idPedido, :extra, :precioLinea)");
    $sql->bindValue(':idArticulo', $idArticulo);
    $sql->bindValue(':cantidad', $cantidad);
    $sql->bindValue(':idPedido', $idPedido);
    $sql->bindValue(':extra', $extra);
    $sql->bindValue(':precioLinea', $precioLinea);
    $sql->execute();

     // Actualizamos el stock del artículo
     actualizarStockPedido($idArticulo, $cantidad);

     // Actualizamos el precio del pedido
     $sqlUpdate = $conexion->prepare("UPDATE pedido SET precioPedido = precioPedido + :precioLinea WHERE idPedido = :idPedido");
     $sqlUpdate->bindValue(':precioLinea', $precioLinea);
     $sqlUpdate->bindValue(':idPedido', $idPedido);
     $sqlUpdate->execute();
}

//Funcion para insert a pedido
function creaPedido($idUsuario, $fecha, $hora,$precioPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("INSERT INTO Pedido (idPedido, idUsuario, fecha, hora, precioPedido) VALUES (NULL, :idUsuario, :fecha, :hora, :precioPedido)");
    $sql->bindValue(':idUsuario', $idUsuario);
    $sql->bindValue(':fecha', $fecha);
    $sql->bindValue(':hora', $hora);
    $sql->bindValue(':precioPedido', $precioPedido);
    $sql->execute();

    return $conexion->lastInsertId();
}

//obtener el nombre del articulo
function obtenerNombreArticulo($idArticulo) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT articulo FROM articulo WHERE idArticulo=:idArticulo");
    $sql->bindParam(':idArticulo', $idArticulo);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $sql->fetch();
    return $resultado['articulo'];
}

//Obtener el precio del artiuclo
function obtenerPrecioArticulo($idArticulo) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT pvp FROM articulo WHERE idArticulo=:idArticulo");
    $sql->bindParam(':idArticulo', $idArticulo);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $sql->fetch();
    return $resultado['pvp'];
}

//obtener idArticulo
function obtenerIdArticulo($nombre_completo) {

    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idArticulo FROM articulo WHERE articulo = :nombre_completo");
    $sql->bindValue(':nombre_completo', $nombre_completo);
    $sql->execute();
    $idArticulo = $sql->fetchColumn();
    if ($idArticulo === false) {
        die('Error: No se pudo obtener idArticulo');
    }
    return $idArticulo;
}
// obtener el precio del articulo
function obtenerPrecioArticuloPorNombre($nombre_completo) {
    $conexion = conectar();
    // Asegúrate de que tu tabla tiene una columna llamada 'precio' que contiene el precio de cada artículo
    $sql = $conexion->prepare("SELECT pvp FROM articulo WHERE articulo = :nombre_completo");
    $sql->bindValue(':nombre_completo', $nombre_completo);
    $sql->execute();
    $precioArticulo = $sql->fetchColumn();
    if ($precioArticulo === false) {
        die('Error: No se pudo obtener el precio del artículo');
    }
    return $precioArticulo;
}

//Obtener el id del usuario
function obtenerIdUsuario() {
    if(session_status() == PHP_SESSION_NONE){
        // Si la sesión no está activa, la iniciamos
        session_start();
    }
    if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['correo'])) {
        $conexion = conectar();
        $sql = $conexion->prepare("SELECT idUsuario FROM usuario WHERE correo=:correo");
        $sql->bindParam(':correo', $_SESSION['correo']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $sql->fetch();
        return $resultado['idUsuario'];
    } else {
        return null;
    }
}

//Obtener el nombre de usuario
function obtenerNombreUsuario($idUsuario) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT nombre FROM usuario WHERE idUsuario=:idUsuario");
    $sql->bindParam(':idUsuario', $idUsuario);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $sql->fetch();
    return $resultado['nombre'];
}


//Funciones de pedidos
function obtenerPedido($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM `pedido` WHERE `idPedido`=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetch();
}

function ultimoPedidoPagado($idUsuario) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT pagado FROM pedido WHERE idUsuario = :idUsuario ORDER BY fecha DESC, hora DESC LIMIT 1");
    $sql->bindValue(':idUsuario', $idUsuario);
    $sql->execute();
    $pedidoPagado = $sql->fetchColumn();
    if ($pedidoPagado === false) {
        return true;
    }
    return $pedidoPagado == 1;
}

function obtenerUltimoPedidoNoPagado($idUsuario) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idPedido FROM pedido WHERE idUsuario = :idUsuario AND pagado = 0 ORDER BY fecha DESC, hora DESC LIMIT 1");
    $sql->bindValue(':idUsuario', $idUsuario);
    $sql->execute();
    $idPedido = $sql->fetchColumn();
    return $idPedido;
}

function obtenerLineasPedido($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM `pedido-linea` WHERE `idPedido`=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll();
}
//pedidos.php
function obtenerIdsPedidoFinalizados() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idPedido FROM pedido WHERE finalizado = 1 AND siendoRealizado=0 AND pagado =0 AND realizado=0");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll(PDO::FETCH_COLUMN);
}
function obtenerIdsPedidosiendoRealizados() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idPedido FROM pedido WHERE siendoRealizado = 1");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll(PDO::FETCH_COLUMN);
}
function obtenerIdsPedidoRealizado() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idPedido FROM pedido WHERE realizado = 1");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll(PDO::FETCH_COLUMN);
}
function obtenerIdsPedidoPagado() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idPedido FROM pedido WHERE pagado = 1");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll(PDO::FETCH_COLUMN);
}

function obtenerPedidoPorUsuario($idUsuario) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT `idPedido` FROM `pedido` WHERE `idUsuario` = :idUsuario");
    $sql->bindParam(':idUsuario', $idUsuario);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll(PDO::FETCH_COLUMN);
}

//Funciones para contabilidad.php
function obtenerTotalesPorMes() {
    // Conectar a la base de datos
    $conexion = conectar();

    // Preparar la consulta SQL
    $sql = $conexion->prepare("SELECT mes, SUM(totalVentas) as totalVentas, SUM(numPedidos) as numPedidos FROM totales GROUP BY mes");

    // Ejecutar la consulta
    $sql->execute();

    // Obtener los resultados
    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Convertir los resultados en un array asociativo con el mes como clave
    $totalesPorMes = array();
    foreach ($resultados as $resultado) {
        $mes = $resultado['mes'];
        $totalesPorMes[$mes] = array(
            'totalVentas' => $resultado['totalVentas'],
            'numPedidos' => $resultado['numPedidos']
        );
    }

    return $totalesPorMes;
}

function actualizarTotales($mes, $totalVentas, $numPedidos) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM totales WHERE mes = :mes");
    $sql->bindValue(':mes', $mes);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $sql = $conexion->prepare("UPDATE totales SET totalVentas = totalVentas + :totalVentas, numPedidos = numPedidos + :numPedidos WHERE mes = :mes");
    } else {
        // Si no existe un total para este mes, insertar uno nuevo
        // Obtener el primer día del mes actual
        $fecha = new DateTime();
        $mes = $fecha->format('Y-m-01');

        $sql = $conexion->prepare("INSERT INTO totales (mes, totalVentas, numPedidos) VALUES (:mes, :totalVentas, :numPedidos)");
    }
    $sql->bindValue(':mes', $mes);
    $sql->bindValue(':totalVentas', $totalVentas);
    $sql->bindValue(':numPedidos', $numPedidos);
    $sql->execute();
}

// eliminar y actualizar cantidad  linea-pedido
function eliminarLinea($idPedidoLinea) {
    $conexion = conectar();

    // Obtén el id del pedido antes de eliminar la línea
    $sqlIdPedido = $conexion->prepare("SELECT idPedido FROM `pedido-linea` WHERE idPedidoLinea = :idPedidoLinea");
    $sqlIdPedido->bindValue(':idPedidoLinea', $idPedidoLinea);
    $sqlIdPedido->execute();
    $idPedido = $sqlIdPedido->fetchColumn();

    // Elimina la línea del pedido
    $sql = $conexion->prepare("DELETE FROM `pedido-linea` WHERE idPedidoLinea = :idPedidoLinea");
    $sql->bindValue(':idPedidoLinea', $idPedidoLinea);
    $sql->execute();

    // Recalcula el precio total del pedido
    $sqlTotal = $conexion->prepare("SELECT SUM(precioLinea) FROM `pedido-linea` WHERE idPedido = :idPedido");
    $sqlTotal->bindValue(':idPedido', $idPedido);
    $sqlTotal->execute();
    $precioTotal = $sqlTotal->fetchColumn();

    // Actualiza el precio total del pedido
    $sqlUpdate = $conexion->prepare("UPDATE pedido SET precioPedido = :precioTotal WHERE idPedido = :idPedido");
    $sqlUpdate->bindValue(':precioTotal', $precioTotal);
    $sqlUpdate->bindValue(':idPedido', $idPedido);
    $sqlUpdate->execute();
}
//obtener el stock de un articulo
function obtenerStockActual($idArticulo) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT stock FROM articulo WHERE idArticulo = :idArticulo");
    $sql->bindValue(':idArticulo', $idArticulo);
    $sql->execute();
    return $sql->fetchColumn();
}

function modificarCantidad($idPedidoLinea, $nuevaCantidad) {
    $conexion = conectar();
    
    // Obtén el id del artículo
    $sqlIdArticulo = $conexion->prepare("SELECT idArticulo FROM `pedido-linea` WHERE idPedidoLinea = :idPedidoLinea");
    $sqlIdArticulo->bindValue(':idPedidoLinea', $idPedidoLinea);
    $sqlIdArticulo->execute();
    $idArticulo = $sqlIdArticulo->fetchColumn();


    // Obtén el precio del artículo utilizando la función obtenerPrecioArticulo
    $precioArticulo = obtenerPrecioArticulo($idArticulo);

    // Calcula el nuevo precio de la línea
    $precioLinea = $precioArticulo * $nuevaCantidad;

    // Actualiza la cantidad y el precio de la línea
    $sql = $conexion->prepare("UPDATE `pedido-linea` SET cantidad = :nuevaCantidad, precioLinea = :precioLinea WHERE idPedidoLinea = :idPedidoLinea");
    $sql->bindValue(':idPedidoLinea', $idPedidoLinea);
    $sql->bindValue(':nuevaCantidad', $nuevaCantidad);
    $sql->bindValue(':precioLinea', $precioLinea);
    $sql->execute();

    // Obtén el id del pedido
    $sqlIdPedido = $conexion->prepare("SELECT idPedido FROM `pedido-linea` WHERE idPedidoLinea = :idPedidoLinea");
    $sqlIdPedido->bindValue(':idPedidoLinea', $idPedidoLinea);
    $sqlIdPedido->execute();
    $idPedido = $sqlIdPedido->fetchColumn();

    // Recalcula el precio total del pedido
    $sqlTotal = $conexion->prepare("SELECT SUM(precioLinea) FROM `pedido-linea` WHERE idPedido = :idPedido");
    $sqlTotal->bindValue(':idPedido', $idPedido);
    $sqlTotal->execute();
    $precioTotal = $sqlTotal->fetchColumn();

    // Actualiza el precio total del pedido
    $sqlUpdate = $conexion->prepare("UPDATE pedido SET precioPedido = :precioTotal WHERE idPedido = :idPedido");
    $sqlUpdate->bindValue(':precioTotal', $precioTotal);
    $sqlUpdate->bindValue(':idPedido', $idPedido);
    $sqlUpdate->execute();
  
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'eliminarLinea') {
            eliminarLinea($_POST['idPedidoLinea']);
        } else if ($_POST['action'] === 'modificarCantidad') {
            modificarCantidad($_POST['idPedidoLinea'], $_POST['nuevaCantidad']);
        }
    }

}



// saber si un pedido esta realizado o no 
function obtenerEstadoPedido($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT realizado FROM pedido WHERE idPedido = :idPedido");
    $sql->bindValue(':idPedido', $idPedido);
    $sql->execute();
    $pedido = $sql->fetch(PDO::FETCH_ASSOC);
    if ($pedido) {
        return $pedido['realizado'];
    } else {
        return false;
    }
}
// saber si un pedido esta finalizado o no 
function obtenerFinalizadoPedido($idPedido) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT finalizado FROM pedido WHERE idPedido = :idPedido");
    $sql->bindValue(':idPedido', $idPedido);
    $sql->execute();
    $pedido = $sql->fetch(PDO::FETCH_ASSOC);
    if ($pedido) {
        return $pedido['finalizado'];
    } else {
        return false;
    }
}
//productos.php
//todos los datos de productos
function obtenerArticulos() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM articulo");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll();
}

function obtenerCategorias() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM categoria");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll();
}

//usuarios.php
function obtenerUsuarios() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM usuario");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    return $sql->fetchAll();
}
function editarUsuarioActual($idUsuario, $nombre, $apellidos, $correo, $tipo, $contrasena) {
    $conexion = conectar();

    $campos = array();
    $valores = array();

    if ($nombre !== null) {
        $campos[] = "nombre = ?";
        $valores[] = $nombre;
    }

    if ($apellidos !== null) {
        $campos[] = "apellidos = ?";
        $valores[] = $apellidos;
    }

    if ($correo !== null) {
        $campos[] = "correo = ?";
        $valores[] = $correo;
    }

    if ($tipo !== null) {
        $campos[] = "tipo = ?";
        $valores[] = $tipo;
    }

    if ($contrasena !== null) {
        $campos[] = "contrasena = ?";
        $valores[] = $contrasena;
    }

    $sql = "UPDATE usuario SET " . implode(", ", $campos) . " WHERE idUsuario = ?";
    $valores[] = $idUsuario;

    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute($valores);

    return $resultado;
}

