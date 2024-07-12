<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/horario.css">
    <title>Cantina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
<?php 
include ("./includes/header.php")
?>
    <div class="reminder">
        <h3>Mensaje enviado correctamente</h3>
        <p>El mensaje ha sido enviado correctamente, pronto nos pondremos en contacto con usted</p>
        <?php
        header('Refresh: 10; URL=contacto.php');
        ?>
    </div>



    <?php
include ("./includes/footer.php")
?>
</body>

</html>