<?php
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
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Publicaciones Recientes</h2>
        <?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                    <?php if (!empty($row['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Post Image" class="img-fluid mb-3">
                    <?php endif; ?>
                    <p class="card-text"><?php echo htmlspecialchars($row['content']); ?></p>
                    <small class="text-muted">Publicado por <?php echo htmlspecialchars($row['author']); ?> el <?php echo $row['created_at']; ?></small>
                    <a href="single_post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mt-3">Ver Publicación</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <footer>
        <p>&copy; 2024 Tradio Gonzalez. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
