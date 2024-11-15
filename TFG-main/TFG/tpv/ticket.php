<?php
require "fpdf/fpdf.php";
session_start();
include "conexion.inc.php";
$conexion=conectar();
$mesa=$_SESSION['mesa'];
$mesa2="Mesa: ".$mesa;
$fecha=date('d-m-Y');
$hora=date('H:i');
$fechahora=$fecha."   ".$hora;
$pdf=new FPDF();
$pdf->AddPage('L','A5');
$pdf->SetFont('Arial','',16);
$pdf->SetXY(10,10);
$pdf->Cell(0,0,"CANTINA RIBERA DE LOS MOLINOS");
$pdf->SetXY(10,15);
$pdf->Cell(0,0,"Especialidad en cafes y bocadillos");
$pdf->SetFont('Arial','',12);
$pdf->SetXY(10,35);
$pdf->Cell(0,0,$mesa2);
$pdf->SetXY(10,45);
$pdf->Cell(0,0,$fechahora);

$consulta="select * from cuenta where mesa=$mesa;";
$resultado=$conexion->query($consulta)->fetchAll();
$pdf->SetFont('Arial','b',14);
$pdf->SetXY(10,65);
$pdf->Cell(0,0,"cant.");
$pdf->SetXY(30,65);
$pdf->Cell(0,0,"producto");
$pdf->SetXY(80,65);
$pdf->Cell(0,0,"precio");
$pdf->SetXY(100,65);
$pdf->Cell(0,0,"total");
$valor=75;
$suma=0;
$pdf->SetFont('Arial','',12);
foreach ($resultado as $fila)
{
$cantidad=$fila['cantidad'];
$idproducto=$fila['idproducto'];
$consulta2="select articulo from articulo where idArticulo=$idproducto;";

$nombre=$conexion->query($consulta2)->fetchColumn();

$consulta3="select pvp from articulo where idArticulo=$idproducto;";

$precio=$conexion->query($consulta3)->fetchColumn();

$pdf->SetXY(10,$valor);
$pdf->Cell(0,0,$cantidad);
$pdf->SetXY(30,$valor);
$pdf->Cell(0,0,$nombre);
$pdf->SetXY(80,$valor);
$pdf->Cell(0,0,$precio);
$total=number_format($precio*$cantidad,2);

$pdf->SetXY(100,$valor);
$pdf->Cell(0,0,$total);
$suma=number_format($suma+$total,2);
$valor=$valor+5;
//echo ", , <br>";

}
$pdf->SetFont('Arial','',16);
$pdf->SetXY(80,$valor+20);
$pdf->Cell(0,0,"TOTAL");

$pdf->SetXY(100,$valor+20);
$pdf->Cell(0,0,$suma);
$pdf->Output();
?>
