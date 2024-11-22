<?php
session_start();
include_once 'config/db.php';
include_once 'classes/Post.php';
include_once 'classes/Comment.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$comment = new Comment($db);

/**
 * Fetch post details and comments if post ID is provided.
 */
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postDetails = $post->readSingle($postId);
    $comments = $comment->readByPostId($postId);
} else {
    echo "Publicación no encontrada.";
    exit;
}

/**
 * Handle comment submission if user is logged in.
 */
if ($_POST && isset($_SESSION['user_id'])) {
    $comment->postId = $postId;
    $comment->userId = $_SESSION['user_id'];
    $comment->content = $_POST['content'];

    if ($comment->create()) {
        header("Location: single_post.php?id=" . $postId);
        exit;
    } else {
        echo "<p style='color:red;'>Error al agregar el comentario.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($postDetails['title']); ?></title>
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2><?php echo htmlspecialchars($postDetails['title']); ?></h2>
        <?php if (!empty($postDetails['image_path'])): ?>
            <img src="<?php echo htmlspecialchars($postDetails['image_path']); ?>" alt="Post Image" class="img-fluid mb-3">
        <?php endif; ?>
        <p><?php echo htmlspecialchars($postDetails['content']); ?></p>
        <small class="text-muted">Publicado por <?php echo htmlspecialchars($postDetails['author']); ?> el <?php echo $postDetails['created_at']; ?></small>

        <h3 class="mt-4">Comentarios</h3>
        <?php while ($row = $comments->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text"><?php echo htmlspecialchars($row['content']); ?></p>
                    <small class="text-muted">Comentado por <?php echo htmlspecialchars($row['username']); ?> el <?php echo $row['created_at']; ?></small>
                </div>
            </div>
        <?php endwhile; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="single_post.php?id=<?php echo $postId; ?>" method="post" class="mt-4">
                <div class="form-group">
                    <textarea name="content" class="form-control" placeholder="Escribe tu comentario" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Comentar</button>
            </form>
        <?php else: ?>
            <p>Por favor, <a href="login.php">inicia sesión</a> para comentar.</p>
        <?php endif; ?>
    </div>
</body>
</html>
