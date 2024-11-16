<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="bg-dark text-white p-3">
    <nav class="container d-flex justify-content-between">
        <a href="index.php" class="text-white">Inicio</a>
        <?php if (isset($_SESSION['username'])): ?>
            <span class="text-white">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="my_posts.php" class="text-white">Mis Publicaciones</a>
            <a href="logout.php" class="text-white">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php" class="text-white">Iniciar Sesión</a>
            <a href="register.php" class="text-white">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>
