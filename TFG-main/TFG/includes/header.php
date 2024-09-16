<?php
session_start(); 
?>

<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/header.css">
<header>
    <div class="header">
        <a href="/TFG-MAIN/TFG/index.php" class="no-animation"><img src="/TFG-MAIN/TFG/IMAGES/logoRibera.png" alt="Logo de la Cantina"></a>
        <nav>
            <ul>
                <li><a href="/TFG-MAIN/TFG/horario.php">Horario</a></li>
                <li>
    <a href="/TFG-MAIN/TFG/cartas/cartaEntera.php">Carta</a>
    <ul class="submenu">
        <li><a href="/TFG-MAIN/TFG/cartas/cartaEntera.php#bocadillosCafes">Bocadillos</a></li><br>
        <li><a href="/TFG-MAIN/TFG/cartas/cartaEntera.php#empanadillasOtros">Empanadillas</a></li><br>
        <li><a href="/TFG-MAIN/TFG/cartas/cartaEntera.php#tostadasPizzas">Pizzas</a></li><br>
        <li><a href="/TFG-MAIN/TFG/cartas/cartaEntera.php#bocadillosCafes">Cafés</a></li><br>
        <li><a href="/TFG-MAIN/TFG/cartas/cartaEntera.php#tostadasPizzas">Tostadas</a></li><br>
        <li><a href="/TFG-MAIN/TFG/cartas/cartaEntera.php#empanadillasOtros">Otros</a></li>
    </ul>
</li>
                <li>
                <?php
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Trabajador') {
    echo '<a href="/TFG-MAIN/TFG/trabajador/contabilidad.php">Contabilidad </a>';
    echo '<a href="/TFG-main/TFG/trabajador/usuarios.php">Usuarios </a>';
    echo '<div class="dropdown">';
    echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos.php">Pedidos</a>';
    echo '<div class="dropdown-content">';
    echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/pendientes.php">Pendientes</a>';
    echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/proceso.php">Realizandose</a>';
    echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/terminados.php">Realizados</a>';
    echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/pagados.php">Pagados</a>';
    echo '</div>';
    echo '</div>';
    echo '<a href="/TFG-MAIN/TFG/trabajador/productos.php">Productos</a>';
} else {
    echo '<a href="/TFG-MAIN/TFG/reservaPedido.php">  Reservar   </a>';
    echo '<a href="/TFG-MAIN/TFG/cesta.php"> Cesta   </a>';
}
?>

            </li>
            </ul>
        </nav>
        <?php
if (isset($_SESSION['username'])) {
    // El usuario ha iniciado sesión
    echo '<div class="user-icon">';
    switch ($_SESSION['tipo']) {
        case 'Alumno':
            $user_icon = 'user_icon_a.png';
            break;
        case 'Profesor':
            $user_icon = 'user_icon_p.png';
            break;
        case 'Trabajador':
            $user_icon = 'user_icon_t.png';
            break;
        default:
            $user_icon = 'user_icon.png';
            break;
    }
    echo '<a href="/TFG-main/TFG/InicioDeSesion/miPerfil.php" class="no-animation"> <img src="/TFG-MAIN/TFG/IMAGES/' . $user_icon . '" alt="Icono de usuario"> Hola, ' . $_SESSION['username'] .'</p> </a>';
    // echo '<p>Hola, ' . $_SESSION['username'] .'</p>';
    echo '<ul class="submenu user-dropdown">';
    echo '<li><a href="/TFG-main/TFG/InicioDeSesion/miPerfil.php">Mi perfil</a></li>';
    echo '<li><a href="/TFG-main/TFG/InicioDeSesion/salir.php">Salir</a></li>'; 
    echo '</ul>';
    echo '</div>';
} else {
    // El usuario no ha iniciado sesión
    echo '<a href="/TFG-main/TFG/InicioDeSesion/inicioSesion.php">Iniciar Sesión</a>';
}
?>

    </div>
</header>