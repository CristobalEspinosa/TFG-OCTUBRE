<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/cartaEntera.css">
    <title>Cantina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
      <!-- bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

</head>

<body>

<?php 
include ("../includes/header.php");
?>


     <!-- contenido de la carta -->
     <h3>Carta Completa</h3>
     <div class="container">
        <div class="row" id="bocadillosCafes">
            <h5>Bocadillos y Cafés</h5>
            <div class="col-md-6">
                <img src="../IMAGES/carta/1.jpg"  alt="Imagen 1">
            </div>
            <div class="col-md-6">
                <img src="../IMAGES/carta/2.jpg" alt="Imagen 2">
            </div>
        </div>
        <div class="row" id="tostadasPizzas">
        <h5>Tostadas y Pizzas</h5>
            <div class="col-md-6">
                <img src="../IMAGES/carta/3.jpg" alt="Imagen 3">
            </div>
            <div class="col-md-6">
                <img src="../IMAGES/carta/4.jpg" alt="Imagen 4">
            </div>
        </div>
        <div class="row" id="empanadillasOtros">
            <h5>Empanadillas y Otros</h5>
            <div class="col-md-6">
                <img src="../IMAGES/carta/5.jpg" alt="Imagen 5">
            </div>
            <div class="col-md-6" >
                <img src="../IMAGES/carta/6.jpg" alt="Imagen 6">
            </div>
        </div>
     </div>

     <?php 
include ("../includes/footer.php");
?>
</body>

</html>
