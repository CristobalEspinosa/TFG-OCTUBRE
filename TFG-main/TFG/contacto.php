<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/contacto.css">
    <title>Cantina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<body>
<?php 
include ("./includes/header.php")
?>
    <h1>Contacto</h1>
    <p>¡Bienvenidos a la Cantina del Instituto! El lugar perfecto para desayunar en el recreo y tomarte un pequeño descanso y en el que estaremos encantados de atenderte <br>
    Si tienes alguna duda no dudes en contactárnos</p>
    <div class="formm">
        <form action="contacto2.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ej:Juan">
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Ej:155453@alu.murciaeduca.es">
            <br>
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required placeholder="Mensaje a enviar"></textarea>
            <br>
            <button type="submit" class="btn btn-outline-warning">Enviar</button>
        </form>
    </div>


    <?php
include ("./includes/footer.php")
?>
</body>

</html>