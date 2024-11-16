<?php
session_start();
include_once 'config/db.php';
include_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_POST) {
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->authorId = $_SESSION['user_id'];

    if ($post->create()) {
        echo "<p style='color:green;'>Publicación creada exitosamente.</p>";
    } else {
        echo "<p style='color:red;'>Error al crear la publicación.</p>";
    }
}

$posts = $post->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicaciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="container mt-4">
            <h1>Crear Publicación</h1>
            <nav class="mb-3">
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </nav>
            <form action="post.php" method="post" enctype="multipart/form-data" class="mb-4">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Título" required>
                </div>
                <div class="form-group">
                    <textarea name="content" class="form-control" placeholder="Contenido" required></textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="image" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    <?php else: ?>
        <nav class="bg-dark text-white p-3">
            <a href="login.php" class="text-white">Iniciar Sesión</a>
        </nav>
    <?php endif; ?>

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
                    <small class="text-muted">Publicado el <?php echo $row['created_at']; ?></small>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
