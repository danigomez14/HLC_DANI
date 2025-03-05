<?php
session_start();

// Eliminar cualquier sesión activa
session_unset(); 
session_destroy();
session_start(); // Reiniciar la sesión después de destruirla

// Si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibe los datos del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Contraseña almacenada en MD5 (hash de "1234")
    $passwordHash = md5(string: "1234");
    $passwordUser = md5(string: "consejo");
    
    // Verifica si el usuario es 'admin' o 'consejo' y la contraseña es correcta
    if ($usuario === 'admin' && md5($password) === $passwordHash) {
        // Si son correctos, guarda el nombre de usuario en la sesión y redirige a leerDatos.php
        $_SESSION['usuario'] = $usuario;
        header("Location: leerDatos.php"); // Redirige a leerDatos.php para el usuario admin
        exit();
    } elseif ($usuario === 'consejo' && md5($password) === $passwordUser) {
        // Si el usuario es 'consejo', redirige a guardarDetalles.php
        $_SESSION['usuario'] = $usuario;
        header("Location: guardarDetalles.php"); // Redirige a guardarDetalles.php para el usuario consejo
        exit();
    } else {
        // Si las credenciales son incorrectas
        $error_message = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Ruta completa a tu archivo CSS local -->
    <link rel="stylesheet" href="C:/xampp/htdocs/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/css/style.css">

    <!-- Bootstrap CSS desde el servidor local -->
    <link rel="stylesheet" href="/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/css/bootstrap.min.css">

    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('C:/xampp/htdocs/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/fonts/Roboto-Regular.woff2') format('woff2'),
                 url('C:/xampp/htdocs/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/fonts/Roboto-Regular.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('C:/xampp/htdocs/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/fonts/Roboto-Bold.woff2') format('woff2'),
                 url('C:/xampp/htdocs/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/fonts/Roboto-Bold.woff') format('woff');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>

<div class="content d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="login-form-07/login.jpg" alt="Imagen" class="img-fluid">
            </div>

            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Iniciar Sesión</h3>
                            <p class="mb-4">Accede a tu cuenta con tus credenciales</p>
                        </div>

                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">
                            <div class="form-group first">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>

                            <div class="form-group last mb-4">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Recordarme</span>
                                    <input type="checkbox" checked="checked"/>
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="#" class="forgot-pass">¿Olvidaste tu contraseña?</a></span> 
                            </div>

                            <input type="submit" value="Ingresar" class="btn btn-block btn-primary">

                            <span class="d-block text-left my-4 text-muted">&mdash; o ingresa con &mdash;</span>
                            <div class="social-login">
                                <a href="#" class="facebook">
                                    <span class="icon-facebook mr-3"></span> 
                                </a>
                                <a href="#" class="twitter">
                                    <span class="icon-twitter mr-3"></span> 
                                </a>
                                <a href="#" class="google">
                                    <span class="icon-google mr-3"></span> 
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/js/bootstrap.bundle.min.js"></script>

</body>
</html>
