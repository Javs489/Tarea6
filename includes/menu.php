<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded shadow-sm mb-4">
    <a class="navbar-brand font-weight-bold" href="../index.php">2º ASIR - Web</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION['usuario'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/ejercicios/index1.php">Edad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ejercicios/index2.php">Número Invertido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ejercicios/index3.php">Calculadora normal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ejercicios/index4.php">Calculadora Científica</a>
                </li>


                <?php if ($_SESSION['usuario'] === 'Admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning font-weight-bold" href="/auth/ver_log.php">Ver Log</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>


        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['usuario'])): ?>

                <li class="nav-item navbar-text text-light mr-3">
                    Usuario: <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-info btn-sm mr-2 text-white" href="/auth/cambiarContraseña.php">Cambiar Contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm text-white" href="/auth/logout.php">Cerrar Sesión</a>
                </li>
            <?php else: ?>

                <li class="nav-item navbar-text text-muted mr-3">Invitado</li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success btn-sm text-white" href="/auth/login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
