<?php
session_start();
include_once 'config/db.php';
include_once 'classes/Post.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$post->authorId = $_SESSION['user_id'];

if ($_GET && isset($_GET['delete_id'])) {
    $postId = $_GET['delete_id'];
    if ($post->delete($postId)) {
        echo "<p style='color:green;'>Publicación eliminada exitosamente.</p>";
    } else {
        echo "<p style='color:red;'>Error al eliminar la publicación.</p>";
    }
}

$posts = $post->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Publicaciones</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <h2>Mis Publicaciones</h2>
        <?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)): ?>
            <?php if ($row['author_id'] == $_SESSION['user_id']): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <?php if (!empty($row['image_path'])): ?>
                            <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Post Image" class="img-fluid mb-3">
                        <?php endif; ?>
                        <p class="card-text"><?php echo htmlspecialchars($row['content']); ?></p>
                        <small class="text-muted">Publicado el <?php echo $row['created_at']; ?></small>
                        <a href="my_posts.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger mt-3">Eliminar</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</body>
</html>
