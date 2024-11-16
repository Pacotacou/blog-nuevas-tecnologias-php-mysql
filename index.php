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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <header class="bg-dark text-white p-3">
        <nav class="container d-flex justify-content-between">
            <a href="login.php" class="text-white">Iniciar Sesión</a>
            <a href="register.php" class="text-white">Registrarse</a>
        </nav>
    </header>

    <div class="container mt-4">
        <h2>Publicaciones Recientes</h2>
        <?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p class="card-text"><?php echo htmlspecialchars($row['content']); ?></p>
                    <small class="text-muted">Publicado por <?php echo htmlspecialchars($row['author']); ?> el <?php echo $row['created_at']; ?></small>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
?>
