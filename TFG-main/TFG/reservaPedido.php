<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reserva</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/reservaPedido.css">
    <title>Cantina-Reserva</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<body>
    <?php
    include("./includes/header.php");
    ?>
    <?php

    if (isset($_SESSION['username'])) {
        echo '<h3 class="tituloReserva">Hora de hacer tu pedido</h3>';

        echo '<form action="/TFG-main/TFG/procesaPedido.php" method="post" class="formulario-pedido container mt-5">';
        echo '<div class="form-group">';
        echo '<label for="tipo" class="label-tipo">Tipo:</label><br>';
        //tipo
        echo '<select id="tipo" name="tipo" class="form-select mb-3 select-tipo ">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="bocadillos">Bocadillos</option>';
        echo '<option value="bebidas">Bebidas</option>';
        echo '<option value="tostadas">Tostadas</option>';
        echo '<option value="pizzas">Pizzas</option>';
        echo '<option value="empanadillas">Empanadillas</option>';
        echo '<option value="otros">Otros</option>';
        echo '</select><br>';
        //bocadillos
        echo '<div id="bocadilloOptions" style="display: none;" class="div-bocadillo-options">';
        echo '<label for="tamano" class="label-tipo">Tamaño:</label><br>';
        echo '<select id="tamano" name="tamano" class="form-select mb-3 select-tipo">';
        echo '<option value="nada">Ningun</option>';
        echo '<option value="medio">Medio</option>';
        echo '<option value="entero">Entero</option>';
        echo '</select><br>';
        //bocadillo medios
        echo '<div id="principalMedio" style="display: none;">';
        echo '<label for="principalMedio" class="label-tipo">Principal:</label><br>';
        echo '<select id="principalMedio" name="principalMedio" class="form-select mb-3 select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Medio Bocadillo Tortilla">Tortilla</option>';
        echo '<option value="Medio Bocadillo Atún">Atún</option>';
        echo '<option value="Medio Bocadillo Jamón Serrano">Jamón Serrano</option>';
        echo '<option value="Medio Bocadillo Jamón Cocido">Jamón Cocido</option>';
        echo '<option value="Medio Bocadillo Queso Fresco">Queso Fresco</option>';
        echo '</select><br>';
        echo '</div>';
        //bocadillo enteros
        echo '<div id="principalEntero" style="display: none;">';
        echo '<label for="principalEntero" class="label-tipo">Principal:</label><br>';
        echo '<select id="principalEntero" name="principalEntero" class="form-select mb-3 select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Entero Bocadillo Tortilla">Tortilla</option>';
        echo '<option value="Entero Bocadillo Atún">Atún</option>';
        echo '<option value="Entero Bocadillo Jamón Serrano">Jamón Serrano</option>';
        echo '<option value="Entero Bocadillo Jamón Cocido">Jamón Cocido</option>';
        echo '<option value="Entero Bocadillo Queso Fresco">Queso Fresco</option>';
        echo '</select><br>';
        echo '</div>';
        //extra Bocadillo
        echo '<div id="extraBocadillo" style="display: none;">';
        echo '<label for="extraBocadillo" class="label-tipo">Extras:</label><br>';
        echo '<select id="extraBocadillo" name="extraBocadillo" class="form-select mb-3 select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Tomate">Tomate</option>';
        echo '<option value="Mayonesa">Mayonesa</option>';
        echo '<option value="Aceite">Aceite</option>';
        echo '<option value="Tomate y Mayonesa">Tomate y Mayonesa</option>';
        echo '<option value="Tomate, Mayonesa y Aceite">Tomate, Mayonesa y Aceite</option>';
        echo '</select><br>';
        echo '</div>';
        echo '</div>';
        //bebidas
        echo '<div id="bebidaOptions" style="display: none;" class="div-bebida-options">';
        echo '<label for="bebida" class="label-tipo">Bebida:</label><br>';
        echo '<select id="bebida" name="bebida" class="form-select mb-3 select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="cafe">Café e Infusiones</option>';
        echo '<option value="refresco">Refresco</option>';
        echo '</select><br>';
        //bebidas cafe
        echo '<div id="cafeOptions" style="display: none;" class="div-cafe-options">';
        echo '<label for="cafe" class="label-tipo">Café e Infusiones:</label><br>';
        echo '<select id="cafe" name="cafe" class="form-select mb-3 select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Café Solo">Solo</option>';
        echo '<option value="Café Manchado">Manchado</option>';
        echo '<option value="Café Cortado">Cortado</option>';
        echo '<option value="Infusión Manzanilla">Manzanilla</option>';
        echo '<option value="Infusión Poleo">Poleo</option>';
        echo '<option value="Infusión Poleo-Menta">Poleo-Menta</option>';
        echo '<option value="Té">Té</option>';
        echo '</select><br>';
        echo '</div>';
        //bebidas refresco
        echo '<div id="refrescoOptions" style="display: none;" class="div-refresco-options">';
        echo '<label for="refresco" class="label-tipo">Refresco:</label><br>';
        echo '<select id="refresco" name="refresco" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Fanta De Naranja">Fanta de Naranja</option>';
        echo '<option value="Fanta de Limón">Fanta de Limón</option>';
        echo '<option value="CocaCola">CocaCola</option>';
        echo '<option value="<Aquarius">Aquarius</option>';
        echo '<option value="Nestea">Nestea</option>';
        echo '<option value="Agua">Agua</option>';
        echo '</select><br>';
        echo '</div>';
        echo '</div>';
        //pizzas
        echo '<div id="pizzaOptions" style="display: none;" class="div-pizza-options">';
        echo '<label for="pizza" class="label-tipo">Pizza:</label><br>';
        echo '<select id="pizza" name="pizza" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Pizza Jamón">Jamón y Queso</option>';
        echo '<option value="Pizza Atún">Atún y Bacon</option>';
        echo '</select><br>';
        echo '</div>';
        //empanadillas
        echo '<div id="empanadillaOptions" style="display: none;" class="div-empanadilla-options">';
        echo '<label for="empanadilla" class="label-tipo">Empanadilla:</label><br>';
        echo '<select id="empanadilla" name="empanadilla" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Empanadilla Jamón">Jamón</option>';
        echo '<option value="Empanadilla Atún">Atún</option>';
        echo '</select><br>';
        echo '</div>';
        //tostadas 
        echo '<div id="tostadaOptions" style="display: none;" class="div-tostada-options">';
        echo '<label for="tostada" class="label-tipo">Tostada: </label><br>';
        echo '<select id="tostada" name="tostada" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Tostada Aceite">Aceite</option>';
        echo '<option value="Tostada Tomate">Tomate</option>';
        echo '<option value="Tostada Atún">Atún</option>';
        echo '<option value="Tostada Aguacate">Aguacate</option>';
        echo '</select><br>';
        echo '</div>';
        //otros
        echo '<div id="otrosOptions" style="display: none;" class="div-otros-options">';
        echo '<label for="otros" class="label-tipo">Otros:</label><br>';
        echo '<select id="otros" name="otros" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="bolsas">Bolsas</option>';
        echo '<option value="chicles">Chicles</option>';
        echo '</select><br>';
        echo '</div>';
        //otros bolsas
        echo '<div id="bolsaOptions" style="display: none;" class="div-bolsa-options">';
        echo '<label for="bolsa" class="label-tipo">Bolsa:</label><br>';
        echo '<select id="bolsa" name="bolsa" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Bolsa Patatas Fritas">Patatas Fritas</option>';
        echo '<option value="Bolsa Doritos">Doritos</option>';
        echo '<option value="Bolsa Fantasmitos">Fantasmitos</option>';
        echo '<option value="Bolsa Gusanitos">Gusanitos</option>';
        echo '</select><br>';
        echo '</div>';
        //otros chicles
        echo '<div id="chicleOptions" style="display: none;" class="div-chicle-options">';
        echo '<label for="chicle" class="label-tipo">Chicle:</label><br>';
        echo '<select id="chicle" name="chicle" class="form-control select-tipo">';
        echo '<option value="nada">Nada</option>';
        echo '<option value="Chicle Melón">Melón</option>';
        echo '<option value="Chicle Fresa">Fresa</option>';
        echo '<option value="Chicle Sandía">Sandía</option>';
        echo '<option value="Chicle Limón">Limón</option>';
        echo '<option value="Chicle Menta">Menta</option>';
        echo '<option value="Caramelo">Caramelo</option>';
        echo '</select><br>';
        echo '</div>';
        echo '<label for="cantidad" class="label-tipo">Cantidad:</label><br>';
        echo '<input type="number" id="cantidad" name="cantidad" value="1" class="form-control select-tipo">';
        echo '</div>';
        echo '<input type="submit" value="Añadir" class="btn btn-outline-warning">';
        echo '</div>';
        echo '</form>';
    } else {
            echo '<div class="login-message">';
            echo '<h1 class="tituloReserva">Por favor inicie sesión para seguir</h1>';
            echo '<p class="pIniciar">Para poder hacer un pedido tienes que <a href="/TFG-main/TFG/InicioDeSesion/inicioSesion.php" class="aIniciar">iniciar sesión</a></p>';
            echo '</div>';
            echo '</br>';
            echo '</br>'; 
            echo '</br>';
            echo '</br>';
            echo '</br>'; 
            echo '</br>';
        }
    ?>
    <?php
    include("./includes/footer.php")
    ?>
</body>
<script>
    $(document).ready(function() {
        $('#tipo').on('change', function() {
            if (this.value == 'bocadillos') {
                $("#bocadilloOptions").show();
                $("#bebidaOptions").hide();
                $("#pizzaOptions").hide();
                $("#empanadillaOptions").hide();
                $("#tostadaOptions").hide();
                $("#otrosOptions").hide();
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            } else if (this.value == 'bebidas') {
                $("#bebidaOptions").show();
                $("#bocadilloOptions").hide();
                $("#pizzaOptions").hide();
                $("#empanadillaOptions").hide();
                $("#tostadaOptions").hide();
                $("#otrosOptions").hide();
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            } else if (this.value == 'pizzas') {
                $("#pizzaOptions").show();
                $("#bocadilloOptions").hide();
                $("#bebidaOptions").hide();
                $("#empanadillaOptions").hide();
                $("#tostadaOptions").hide();
                $("#otrosOptions").hide();
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            } else if (this.value == 'empanadillas') {
                $("#empanadillaOptions").show();
                $("#bocadilloOptions").hide();
                $("#bebidaOptions").hide();
                $("#pizzaOptions").hide();
                $("#tostadaOptions").hide();
                $("#otrosOptions").hide();
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            } else if (this.value == 'tostadas') {
                $("#tostadaOptions").show();
                $("#bocadilloOptions").hide();
                $("#bebidaOptions").hide();
                $("#pizzaOptions").hide();
                $("#empanadillaOptions").hide();
                $("#otrosOptions").hide();
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            } else if (this.value == 'otros') {
                $("#otrosOptions").show();
                $("#bocadilloOptions").hide();
                $("#bebidaOptions").hide();
                $("#pizzaOptions").hide();
                $("#empanadillaOptions").hide();
                $("#tostadaOptions").hide();
            } else {
                $("#bocadilloOptions").hide();
                $("#bebidaOptions").hide();
                $("#pizzaOptions").hide();
                $("#empanadillaOptions").hide();
                $("#tostadaOptions").hide();
                $("#otrosOptions").hide();
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            }
        });

        $('#tamano').on('change', function() {
            if (this.value == 'medio') {
                $("#principalMedio").show();
                $("#principalEntero").hide();
                $("#extraBocadillo").show();
            } else if (this.value == 'entero') {
                $("#principalEntero").show();
                $("#principalMedio").hide();
                $("#extraBocadillo").show();
            } else {
                $("#principalMedio").hide();
                $("#principalEntero").hide();
                $("#extraBocadillo").hide();
            }
        });

        $('#bebida').on('change', function() {
            if (this.value == 'cafe') {
                $("#cafeOptions").show();
                $("#refrescoOptions").hide();
            } else if (this.value == 'refresco') {
                $("#refrescoOptions").show();
                $("#cafeOptions").hide();
            } else {
                $("#cafeOptions").hide();
                $("#refrescoOptions").hide();
            }
        });

        $('#otros').on('change', function() {
            if (this.value == 'bolsas') {
                $("#bolsaOptions").show();
                $("#chicleOptions").hide();
            } else if (this.value == 'chicles') {
                $("#chicleOptions").show();
                $("#bolsaOptions").hide();
            } else {
                $("#bolsaOptions").hide();
                $("#chicleOptions").hide();
            }
        });
    });
</script>

<script>
window.onerror = function() {
    return true;
}

$(document).ready(function() {
    $("form").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: '/TFG-main/TFG/procesaPedido.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(response) {
                alert("El pedido se ha añadido a la cesta");
                setTimeout(function(){ 
                    location.reload();
                }, 1000); 
            }
        });
    });
});

</script>



</html>