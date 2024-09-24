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


<div class="tresd" id="tresdContainer"></div>
<div class="container">
    <h1>Iniciar sesión</h1>
    <form id="loginForm" action="compruebaLogin.php" method="post">
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
        <p>P@ssw0rd1</p>
        <button type="submit">Entrar</button>
    </form>
    <h3>¿No tienes cuenta aún?</h3>
    <button onclick="location.href='registro.php'" type="button">Registrarse</button>
</div>

<script>
    let scriptLoaded = false;

    function load3DScript() {
        if (!scriptLoaded) {
            scriptLoaded = true;
            var script = document.createElement('script');
            script.type = 'module';
            script.src = 'https://unpkg.com/@splinetool/viewer@1.9.3/build/spline-viewer.js';
            script.onload = function() {
                var splineViewer = document.createElement('spline-viewer');
                splineViewer.setAttribute('loading-anim-type', 'spinner-big-light');
                splineViewer.setAttribute('url', 'https://prod.spline.design/heiNfcmdzfmGmbCt/scene.splinecode');
                document.getElementById('tresdContainer').appendChild(splineViewer);
            };
            document.body.appendChild(script);
        }
    }

    document.getElementById('contrasena').addEventListener('input', load3DScript);
</script>
</body>
</html>