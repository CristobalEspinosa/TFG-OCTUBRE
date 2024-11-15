<?php
session_start();
$mesa=$_GET['mesa'];
$_SESSION['mesa']=$mesa;
header('Location:index.php');
?>