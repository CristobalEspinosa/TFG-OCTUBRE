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
/*registrar nuevo producto*/
function registrarArticulo($articulo, $pvp,$precioCompra, $stock, $idProveedor, $idCategoria) {
    $conexion = conectar();
    // Preparar la consulta SQL para insertar el artículo
    $sql = $conexion->prepare("INSERT INTO articulo (articulo, pvp, precioCompra, stock, idProveedor, idCategoria) VALUES (:articulo, :pvp, :precioCompra, :stock, :idProveedor, :idCategoria)");
    // Asociar los valores a los parámetros
    $sql->bindValue(':articulo', $articulo);
    $sql->bindValue(':pvp', $pvp);
    $sql->bindValue(':precioCompra', $precioCompra);
    $sql->bindValue(':stock', $stock);
    $sql->bindValue(':idProveedor', $idProveedor);
    $sql->bindValue(':idCategoria', $idCategoria);
    // Ejecutar la consulta
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

//horario
function mostrarHorario(){
    $conexion = conectar();

    // Consulta para obtener todos los días y horarios, omitiendo el idDia
    $sql = $conexion->prepare("SELECT dia, horario FROM horario");
    $sql->execute();

    // Recuperar los resultados como un array asociativo
    $horarios = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $horarios; // Devolver el array de horarios
}
function actualizaHorario($dia, $nuevo_horario) {
    // Conectar a la base de datos (asumo que tienes una función `conectar()`)
    $conexion = conectar();

    // Consulta preparada para actualizar el horario
    $sql = $conexion->prepare("UPDATE horario SET horario = :nuevo_horario WHERE dia = :dia");

    // Asignar los valores a los parámetros
    $sql->bindValue(':nuevo_horario', $nuevo_horario);
    $sql->bindValue(':dia', $dia);

    // Ejecutar la consulta
    $resultado = $sql->execute();

    // Comprobar si la actualización fue exitosa
    if ($resultado) {
        return true; // Actualización exitosa
    } else {
        return false; // Hubo un error en la actualización
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

    // Obtener el número de teléfono del usuario
    $sql = $conexion->prepare("SELECT telefono FROM usuario INNER JOIN pedido ON usuario.idUsuario = pedido.idUsuario WHERE pedido.idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    $numero_destino = $usuario['telefono']; 

    // Mensaje de WhatsApp
    $mensaje = urlencode("Hola buenas, somos de la cantina del IES Ribera de los Molinos, tu pedido está realizado y listo para recogerse");
    $url_whatsapp = "https://wa.me/$numero_destino?text=$mensaje";

    // Redirigir a WhatsApp
    echo "<script type='text/javascript'>window.open('$url_whatsapp', '_blank');</script>";
    exit();
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

    $sql = $conexion->prepare("UPDATE pedido SET pagado=1, realizado=0 WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->execute();

    // Actualizar la cantidad actual de la caja
    $sqlActualizarCaja = $conexion->prepare("UPDATE caja SET cantidadActual = cantidadActual + :precio");
    $sqlActualizarCaja->bindParam(':precio', $precio);
    $sqlActualizarCaja->execute();

    $fecha = new DateTime();
    $mes = $fecha->format('Y-m-01');
    
    actualizarTotales(0, 1);
}

if (isset($_POST['action']) && $_POST['action'] === 'eliminarPedido') {
     if (isset($_POST['idPedido'])) { 
        $idPedido = $_POST['idPedido']; 
        eliminarPedido($idPedido); 
        echo json_encode(['success' => true]);
         exit; 
        } else {
             echo json_encode(['success' => false, 'message' => 'ID de pedido no encontrado']);
              exit; 
            } 
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
function finalizarPedidoConHoraFecha($idPedido, $horaRecogida,$fechaRecogida) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE pedido SET finalizado=1, horaRecogida=:horaRecogida, fechaRecogida=:fechaRecogida WHERE idPedido=:idPedido");
    $sql->bindParam(':idPedido', $idPedido);
    $sql->bindParam(':horaRecogida', $horaRecogida);
    $sql->bindParam(':fechaRecogida', $fechaRecogida);
    $sql->execute();

    if ($_POST['action'] == 'finalizar') {
        $idPedido = $_POST['idPedido'];
        $horaRecogida = $_POST['horaRecogida']; 
        $fechaRecogida = $_POST['fechaRecogida']; 
        finalizarPedidoConHoraFecha($idPedido, $horaRecogida,$fechaRecogida);
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

function obtenerPedidosNoPagados($idUsuario) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM `pedido` WHERE `idUsuario` = :idUsuario AND `pagado` = 0");
    $sql->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los pedidos no pagados como un array asociativo
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
    $sql = $conexion->prepare("SELECT idPedido FROM pedido WHERE finalizado = 1 AND (siendoRealizado = 0 OR siendoRealizado IS NULL) AND pagado = 0 AND realizado = 0");
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
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idBeneficios, mes, totalVentas, numPedidos FROM totales");
    $sql->execute();

    // Obtener los resultados
    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
    $totalesPorMes = array();
    foreach ($resultados as $resultado) {
        $mes = $resultado['mes'];
        $totalesPorMes[$mes] = array(
            'idBeneficios' => $resultado['idBeneficios'],
            'totalVentas' => $resultado['totalVentas'],
            'numPedidos' => $resultado['numPedidos']
        );
    }

    return $totalesPorMes;
}


function actualizarTotales($totalVentas, $numPedidos) {
    $conexion = conectar();
    
    // Obtener el primer día del mes actual
    $fecha = new DateTime();
    $mes = $fecha->format('Y-m-01');
    
    // Verificar si ya existe un registro para el mes actual
    $sql = $conexion->prepare("SELECT * FROM totales WHERE mes = :mes");
    $sql->bindValue(':mes', $mes);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    
    if ($resultado) {
        // Si existe un registro para el mes, actualizarlo
        $sql = $conexion->prepare("UPDATE totales SET totalVentas = totalVentas + :totalVentas, numPedidos = numPedidos + :numPedidos WHERE mes = :mes");
    } else {
        // Si no existe un registro para el mes, insertar uno nuevo
        $sql = $conexion->prepare("INSERT INTO totales (mes, totalVentas, numPedidos) VALUES (:mes, :totalVentas, :numPedidos)");
    }
    
    $sql->bindValue(':mes', $mes);
    $sql->bindValue(':totalVentas', $totalVentas, PDO::PARAM_STR);
    $sql->bindValue(':numPedidos', $numPedidos, PDO::PARAM_INT);
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
//pagos
function registrarPago($concepto, $cantidad, $idBeneficios) {
    $conexion = conectar();
    $conexion->beginTransaction();
    try {
        $sql = $conexion->prepare("INSERT INTO pagos (concepto, cantidad, idTotales) VALUES (:concepto, :cantidad, :idTotales)");
        $sql->bindValue(':concepto', $concepto);
        $sql->bindValue(':cantidad', $cantidad);
        $sql->bindValue(':idTotales', $idBeneficios); 
        $sql->execute();

        $sqlUpdate = $conexion->prepare("UPDATE totales SET totalVentas = totalVentas - :cantidad WHERE idBeneficios = :idBeneficios");
        $sqlUpdate->bindValue(':cantidad', $cantidad);
        $sqlUpdate->bindValue(':idBeneficios', $idBeneficios);
        $sqlUpdate->execute();

        $conexion->commit();
    } catch (Exception $e) {
        $conexion->rollBack();
        throw $e;
    }
}


function modificarTotalVentas($idBeneficios, $nuevoTotalVentas) {
    $conexion = conectar();
    $sql = $conexion->prepare("UPDATE totales SET totalVentas = :nuevoTotalVentas WHERE idBeneficios = :idBeneficios");
    $sql->bindValue(':nuevoTotalVentas', $nuevoTotalVentas, PDO::PARAM_STR);
    $sql->bindValue(':idBeneficios', $idBeneficios, PDO::PARAM_INT);
    return $sql->execute();
}

function obtenerBeneficios() { 
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT idBeneficios, mes FROM totales");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function obtenerGastosPorBeneficio($idTotales) {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT * FROM pagos WHERE idTotales = :idTotales");
    $sql->bindValue(':idTotales', $idTotales);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
//caja
function isCajaAbierta() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT abierta FROM caja WHERE idCaja = 1");
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    return $resultado['abierta'] == 1;
}
function abrirCaja() { 
    $conexion = conectar(); 
    $sql = $conexion->prepare("UPDATE caja SET abierta = 1 WHERE idCaja = 1"); 
    $sql->execute(); 
}
function cerrarCaja() {
    $conexion = conectar();
 
    $sql = $conexion->prepare("SELECT cantidadActual FROM caja WHERE idCaja = 1");
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    
    $beneficioDiario = $resultado['cantidadActual'] - 200;
  
    $sql = $conexion->prepare("UPDATE caja SET abierta = 0, cantidadActual = 200 WHERE idCaja = 1");
    $sql->execute();
    
    actualizarTotales($beneficioDiario, 0);

    // Usar ruta absoluta
    $rutaArchivo = __DIR__ . "/cajaDiaria.csv";
    $archivo = fopen($rutaArchivo, "a");

    if ($archivo === false) {
        die("Error: No se pudo abrir el archivo de texto en la ruta: $rutaArchivo");
    }
    
    $fechaCierre = date("Y-m-d H:i:s"); 
    $linea = "Fecha: $fechaCierre - Beneficio Diario: $beneficioDiario\n";

    if (fwrite($archivo, $linea) === false) {
        die("Error: No se pudo escribir en el archivo de texto.");
    }

    fclose($archivo);
}



function obtenerCantidadActual() {
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT cantidadActual FROM caja WHERE idCaja = 1");
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    return $resultado['cantidadActual'];
}