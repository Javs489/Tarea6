<?php
session_start();

$NombreDeUsuarioQueCierraSesion = $_SESSION['usuario'] ?? 'Invitado';
$MensajeDeLog = "[" . date("Y-m-d H:i:s") . "] - Usuario: $NombreDeUsuarioQueCierraSesion - Acción: Cierre de sesión";
file_put_contents('log.txt', $MensajeDeLog, FILE_APPEND);

$_SESSION = [];

session_destroy();

header("Location: login.php");
exit();