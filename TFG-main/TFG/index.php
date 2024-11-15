<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <title>Cantina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<?php
include("./includes/header.php");
include './db/bd.inc.php';

// Verificar si el usuario es "Trabajador" y si la caja está abierta
$esTrabajador = isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'Trabajador';
$cajaAbierta = isCajaAbierta();
?>
<script>    
    async function obtenerCantidadActual() {
    try {
        const response = await fetch('./caja.php?action=obtenerCantidad');
        const data = await response.json();
        if (data.success) {
            document.getElementById('cantidad-actual').textContent = "Caja actual: " + data.cantidad;
        } else {
            console.error('Error al obtener la cantidad actual: ' + (data.error || 'Respuesta no válida'));
        }
    } catch (error) {
        console.error('Error de red o de servidor: ', error);
    }
}
</script>
<body>
    <?php if ($esTrabajador && !$cajaAbierta): ?>
        <!-- Vista en blanco solo para Trabajadores cuando la caja está cerrada -->
        <div class="caja-abrir-contenedor">
            <button id="abrirCajaButton" onclick="abrirCaja()">Abrir Caja</button>
        </div>
    <?php else: ?>
        <!-- Mostrar el contenido normal del index -->
        <div class="carousel">
            <div class="carousel-item">
                <div class="cantina-image">
                    <a href="reserva.php"><img src="./IMAGES/cantinaTrabajando.jpg" alt="Trabajador en la cantina"></a>
                    <p class="cantina-quote">“Donde los apuntes se mezclan con los sabores”</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="cantina-image">
                    <a href="reserva.php"><img src="./IMAGES/cantina5.jpg" alt="Otra imagen"></a>
                    <p class="cantina-quote">“Estudiar nunca fue tan delicioso”</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="cantina-image">
                    <a href="reserva.php"><img src="./IMAGES/cantina2.jpg" alt="Otra imagen"></a>
                    <p class="cantina-quote">“Sabores que alimentan la mente y el alma”</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="cantina-image">
                    <a href="reserva.php"><img src="./IMAGES/cantina4.jpg" alt="Otra imagen"></a>
                    <p class="cantina-quote">“La cantina: el aula más sabrosa”</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="cantina-image">
                    <a href="reserva.php"><img src="./IMAGES/cantina3.jpg" alt="Otra imagen"></a>
                    <p class="cantina-quote">“Un rincón para estudiar y disfrutar”</p>
                </div>
            </div>
        </div>
        <div class="carousel-buttons">
            <button class="carousel-button" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-button" onclick="nextSlide()">&#10095;</button>
        </div>

        <?php if ($esTrabajador && $cajaAbierta): ?>
            <div class="text-center">
             <a href="./tpv/index.php"><img src="tpv/fotos/tpv.jpg" width="100"></a>
                <button onclick="cerrarCaja()">Cerrar caja</button>
                <span id="cantidad-actual">Caja actual:</span>
            </div>
            <script>
                obtenerCantidadActual();
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <script>
        // Funciones de carrusel
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');

        function showSlide(index) {
            items.forEach((item, i) => {
                item.style.transform = `translateX(${(i - index) * 100}%)`;
                item.style.display = (i === index) ? 'block' : 'none';
            });
        }

        function prevSlide() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
            showSlide(currentIndex);
        }

        function nextSlide() {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            showSlide(currentIndex);
        }

        showSlide(currentIndex);
        
        async function abrirCaja() {
                    const response = await fetch('./caja.php?action=abrir');
                    const data = await response.json();
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al abrir la caja.');
                    }
                }
                async function cerrarCaja() {
                    const response = await fetch('./caja.php?action=cerrar');
                    const data = await response.json();
                    if (data.success) {
                        location.reload(); // Recarga para ocultar el contenido
                    } else {
                        alert('Error al cerrar la caja.');
                    }
                }
    </script>
</body>

<?php include("./includes/footer.php"); ?>

</html>