<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioInput = $_POST['usuario'] ?? '';
    $passInput = $_POST['contrasena'] ?? '';
    $fichero = 'credenciales.txt';

    if (file_exists($fichero)) {
        
        $contenidoCredenciales = file_get_contents($fichero);

        if (str_contains($contenidoCredenciales, $usuarioInput) && str_contains($contenidoCredenciales, $passInput)) {
            
            $_SESSION['usuario'] = $usuarioInput;

            $logMsg = "[" . date("Y-m-d H:i:s") . "] - Usuario: $usuarioInput - Acción: Login exitoso\n";
            file_put_contents('log.txt', $logMsg, FILE_APPEND);

            header("Location: ../index.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "No se encuentra el fichero de credenciales.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 400px;">
    <h3>Iniciar Sesión</h3>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>Usuario:</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning btn-block">Loguearse</button>
    </form>
</body>
</html>
