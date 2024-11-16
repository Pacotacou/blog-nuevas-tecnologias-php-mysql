<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <h1>Crear Publicación</h1>
    <nav>
        <a href="logout.php">Cerrar Sesión</a>
    </nav>
    <form action="post.php" method="post">
        <input type="text" name="title" placeholder="Título" required>
        <textarea name="content" placeholder="Contenido" required></textarea>
        <button type="submit">Publicar</button>
    </form>

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
