<?php
session_start();
if (!isset($_SESSION['usuario'])) 
    {
    header("Location: login.php");
    exit();
    }

$mensaje = $tipoAlerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    $passActual = $_POST['contrasenaAnterior'] ?? '';
    $passNueva = $_POST['contrasenaNueva'] ?? '';
    $repetirPass = $_POST['repetirContrasena'] ?? '';


    $fichero = 'credenciales.txt';

    if (!file_exists($fichero)) 
    {
        $mensaje = "No se encuentra el fichero de credenciales.";
        $tipoAlerta = "alert-danger";
    } 
    else 
    {
        $contenido = file_get_contents($fichero);

        if (!str_contains($contenido, $passActual))
        {
            $mensaje = "La contraseña actual es incorrecta.";
            $tipoAlerta = "alert-danger";
        } 
        elseif ($passNueva !== $repetirPass) 
        {
            $mensaje = "Las nuevas contraseñas no coinciden.";
            $tipoAlerta = "alert-danger";
        } 
        else 
        {
            $nuevoContenido = str_replace($passActual, $passNueva, $contenido);
            file_put_contents($fichero, $nuevoContenido);

            $mensaje = "Contraseña actualizada";
            $tipoAlerta = "alert-success";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <?php require '../includes/menu.php'; ?>
    <h3>Cambiar Contraseña</h3>

    <?php if ($mensaje): ?>
        <div class="alert <?php echo $tipoAlerta; ?> mt-3"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-3" style="max-width: 450px;">
        <div class="form-group">
            <label>Contraseña Actual:</label>
            <input type="password" name="contrasenaAnterior" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nueva Contraseña:</label>
            <input type="password" name="contrasenaNueva" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Repetir Nueva Contraseña:</label>
            <input type="password" name="repetirContrasena" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning float-right">Actualiza tu Contraseña</button>
    </form>
</body>
</html>
