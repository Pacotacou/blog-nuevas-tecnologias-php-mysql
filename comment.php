<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include_once 'classes/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

if ($_POST) {
    $comment->postId = $_POST['postId'];
    $comment->userId = $_SESSION['user_id'];
    $comment->content = $_POST['content'];

    if ($comment->create()) {
        echo "<p style='color:green;'>Comentario agregado exitosamente.</p>";
    } else {
        echo "<p style='color:red;'>Error al agregar el comentario.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <h1>Agregar Comentario</h1>
    <div class="container mt-4">
        <nav class="mb-3">
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </nav>
        <form action="comment.php" method="post" class="mb-4">
            <input type="hidden" name="postId" value="1"> <!-- Aquí deberías usar el ID de la publicación actual -->
            <div class="form-group">
                <textarea name="content" class="form-control" placeholder="Escribe tu comentario" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comentar</button>
        </form>
    </div>
</body>
</html>
