<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
<link rel="stylesheet" href="../CSS/inicioSesion.css">
</head>
<body>
<header>
    <a href="/TFG-main/TFG/index.php" class="atras">Volver atrás</a>
</header>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <form action="compruebaLogin.php" method="post">
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <h3>¿No tienes cuenta aún?</h3>
        <button onclick="location.href='registro.php'" type="button">Registrarse</button>
    </div>
</body>
</html>