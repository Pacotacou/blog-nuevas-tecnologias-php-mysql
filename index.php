<?php
session_start();
include_once 'config/db.php';
include_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$posts = $post->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <header>
        <nav>
            <a href="login.php">Iniciar Sesión</a>
            <a href="register.php">Registrarse</a>
        </nav>
    </header>

    <h2>Publicaciones Recientes</h2>
    <?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)): ?>
        <div>
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <small>Publicado el <?php echo $row['created_at']; ?></small>
        </div>
    <?php endwhile; ?>
</body>
</html>
?>
