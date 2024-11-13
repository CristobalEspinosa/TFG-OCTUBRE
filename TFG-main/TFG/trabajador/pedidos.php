<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/pedidos.css">
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/footer.css">
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/header.css">
<title>Cantina-Pedidos</title>
<?php
include("../includes/header.php");
?>
<h1>Listado de pedidos</h1>
<?php
include '../db/bd.inc.php';

echo '<div class="container">';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/pendientes.php" class="boxP">Pendientes</a>';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/proceso.php" class="boxEP">En Proceso</a>';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/terminados.php" class="boxT">Terminados</a>';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/pagados.php" class="boxPG">Pagados</a>';
echo '</div>';



?>
<?php
include("../includes/footer.php");
?>