<?php
session_start();

if (!isset($_SESSION['usuario'])) 
    {
    header("Location: login.php");
    exit();
}
if ($_SESSION['usuario'] !== 'Admin') 
    {
    http_response_code(403);
    die("Denegado: El usuario Admin puede ver el log.");
}
$RutaDelFicheroDeLog = 'log.txt';
$ContenidoDelLog = file_exists($RutaDelFicheroDeLog)
    ? file_get_contents($RutaDelFicheroDeLog)
    : "El fichero de log todavía no existe.";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logs de operaciones</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <?php require '../includes/menu.php'; ?>
    <h1>Logs de operaciones</h1>
    <pre class="bg-light p-3 border rounded"><?php echo htmlspecialchars($ContenidoDelLog); ?>
    </pre>
</body>
</html>