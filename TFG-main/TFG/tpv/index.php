<?php
session_start();
include "conexion.inc.php";
$conexion=conectar();

if (!(isset($_SESSION['mesa'])))
{
$mesa=1;
}
else
{
$mesa=$_SESSION['mesa'];
}

if (!(isset($_SESSION['categoria'])))
{
$categoria=1;
}
else
{
$categoria=$_SESSION['categoria'];
}


?>
<body bgcolor="lightgrey">
<center>
<table width="70%" bgcolor="white" border="0" cellspacing="0" cellpadding="0"><tr>
<tr>
    <td><a href="../index.php"><img src="fotos/volver.png" width="100"></a></td>
<td><img src="fotos/restaurante.gif" width="100"></td><td><font size="6"><b>TPV RIBERA DE LOS MOLINOS</b></font><br><font size="4"><i>Especialidad en cafes y bocadillos</i></font></td>
</tr>
</table>
<br>
<table width="70%" bgcolor="white" border="0" cellspacing="0" cellpadding="0"><tr>
<tr>
<td valign="middle"><center><font size="5"><b>MESA</b></font></td>
<td><input type="image" src="fotos/1.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=1');">
<input type="image" src="fotos/2.jpg" name="2" width="100" height="60" onclick="location.replace('mesa.php?mesa=2');">
<input type="image" src="fotos/3.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=3');">
<input type="image" src="fotos/4.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=4');">
<input type="image" src="fotos/5.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=5');">
<input type="image" src="fotos/6.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=6');">
<input type="image" src="fotos/7.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=7');">
<input type="image" src="fotos/8.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=8');">
<input type="image" src="fotos/9.jpg" name="1" width="100" height="60" onclick="location.replace('mesa.php?mesa=9');">
</td>
</tr>
</table>
<br>
<table width="70%" border="0" bgcolor="white">
<tr>
<td width="70%" border="0">
<center>
<font size="5"><b>CATEGORIAS</b></font>
<table>
<tr>

<?php
$categorias=getCategorias();
$conta=1;
foreach ($categorias as $fila) {
$idcategoria=$fila['idCategoria'];
$nombre=$fila['tipo'];
$imagen=$fila['imagen'];
echo "<td><center><input type='image' src='productos/".$imagen."' name='id_categoria' width='100' height='70' onclick=\"location.replace('categoria.php?categoria=$idcategoria');\"><br>$nombre</td>";
$conta++;
if ($conta==8) {
echo "</tr><tr>";
$conta=1;
}

}
?>

</tr>
</table>

</td>
<td rowspan="2">
<center>
<?php

echo "<font size=\"5\"><b>CUENTA MESA: $mesa<b></font>"
?>
<br><br>
<table border="1" width="95%" cellspacing="2" rules="all" >
<tr bgcolor="bisque">
<th>Cant.</th>
<th>Producto</th>
<th>Precio</th>
</tr>
<?php
$consulta="SELECT * FROM cuenta where mesa=$mesa;";
$resultado=$conexion->query($consulta)->fetchAll();
$suma=0;
foreach ($resultado as $fila) {
$cantidad=$fila['cantidad'];
$idproducto=$fila['idproducto'];
$consulta2="select articulo from articulo where idArticulo=$idproducto;";
$nombre=$conexion->query($consulta2)->fetchColumn();

$consulta3="select pvp from articulo where idArticulo=$idproducto;";
$precio=$conexion->query($consulta3)->fetchColumn();
$pvp= number_format($precio*$cantidad,2);

$suma= number_format($suma+$pvp,2);
echo "<tr><td align='right' width='10%'>$cantidad</td><td>$nombre</td>
<td align='right' width='15%'>$pvp</td></tr>";
}
?>
</table>
</td>
<tr>
<td rowspan="2" valign="top">
<?php
echo "<hr><br><br><center>";
?>

<table border="1" rules="all">
<?php
$cons1="select * from articulo where idCategoria =$categoria";
$res1=$conexion->query($cons1)->fetchAll();
echo "<tr>";
$contador=1;
foreach($res1 as $fil)
{
$idproducto=$fil['idArticulo'];
$foto=$fil['imagen'];
$nombre=$fil['articulo'];
echo "<td><a href='cuenta.php?idproducto=$idproducto'><img src='productos/$foto' width='100' height='80'></a><br><center>$nombre</td>";
if ($contador==6)
{
$contador=0;
echo "</tr><tr>";
}
$contador++;
}
?>
</tr>


</table>

</td>
</tr>
<tr>
<td valign="top">
<hr>
<center>
<input type="image" src="fotos/borrar.jpg" name="borrar" width="150" height="30" onclick="location.replace('borrar.php');">
<hr>
<?php
echo "<font size='5'><b>TOTAL: </b>$suma</font>";
?>
<hr>
<?php
echo "<input type='image' src='fotos/ticket.jpg' name='borrar' width='100' height='70' onclick=\"window.open('ticket.php','ticket','width=800, height=600');\">";

echo "&nbsp;&nbsp;&nbsp;";

echo "<input type='image' src='fotos/finalizar.jpg' name='borrar' width='100' height='70' onclick=\"location.replace('finalizar.php?total=$suma');\">";
?>
</td>
</tr>
</table>

