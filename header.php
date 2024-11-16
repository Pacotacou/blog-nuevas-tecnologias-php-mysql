<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<h1 style="text-align: center; margin-top: 20px;">BLOG DE NUEVAS TECNOLOGÍAS</h1>
<?php if (isset($_SESSION['username'])): ?>
    <p style="text-align: center;">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<?php endif; ?>
<header>
    <nav class="container d-flex justify-content-between align-items-center">
        <a href="index.php">Inicio</a>
        <div>
            <?php if (isset($_SESSION['username'])): ?>
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="post.php">Crear Publicación</a>
                <a href="my_posts.php">Mis Publicaciones</a>
                <a href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar Sesión</a>
                <a href="register.php">Registrarse</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
