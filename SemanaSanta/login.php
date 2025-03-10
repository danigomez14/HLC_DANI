<?php
session_start();

// Verificar si ya existe una cookie y autocompletar el usuario
$usuario_guardado = isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : "";

// Si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $recordar = isset($_POST['recordar']);

    // Contraseñas almacenadas en hash MD5
    $passwordHash = md5("1234");
    $passwordUser = md5("consejo");

    if ($usuario === 'admin' && md5($password) === $passwordHash) {
        $_SESSION['usuario'] = $usuario;

        // Guardar cookie si el usuario marcó "Recordarme"
        if ($recordar) {
            setcookie("usuario", $usuario, time() + (30 * 24 * 60 * 60), "/"); // 30 días
        } else {
            setcookie("usuario", "", time() - 3600, "/"); // Eliminar cookie
        }

        header("Location: leerDatos.php");
        exit();
    } elseif ($usuario === 'consejo' && md5($password) === $passwordUser) {
        $_SESSION['usuario'] = $usuario;

        if ($recordar) {
            setcookie("usuario", $usuario, time() + (30 * 24 * 60 * 60), "/");
        } else {
            setcookie("usuario", "", time() - 3600, "/");
        }

        header("Location: guardarDetalles.php");
        exit();
    } else {
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
    <link rel="stylesheet" href="C:/xampp/htdocs/dashboard/hlc_2425/HLC_DANI/HLC_DANI-1/SemanaSanta/login-form-07/css/style.css">
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
                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario_guardado); ?>" required>
                            </div>

                            <div class="form-group last mb-4">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0">
                                    <span class="caption">Recordarme</span>
                                    <input type="checkbox" name="recordar" <?= $usuario_guardado ? 'checked' : ''; ?>/>
                                    <div class="control__indicator"></div>
                                </label>
                            </div>

                            <input type="submit" value="Ingresar" class="btn btn-block btn-primary">
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
