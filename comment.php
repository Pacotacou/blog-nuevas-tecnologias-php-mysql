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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Agregar Comentario</h1>
    <nav>
        <a href="logout.php">Cerrar Sesión</a>
    </nav>
    <form action="comment.php" method="post">
        <input type="hidden" name="postId" value="1"> <!-- Aquí deberías usar el ID de la publicación actual -->
        <textarea name="content" placeholder="Escribe tu comentario" required></textarea>
        <button type="submit">Comentar</button>
    </form>
</body>
</html>
