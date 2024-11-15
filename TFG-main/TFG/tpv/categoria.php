<?php
session_start();
$categoria=$_GET['categoria'];
$_SESSION['categoria']=$categoria;
header('Location:index.php');
?>
