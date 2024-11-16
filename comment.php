<?php
include_once 'config/db.php';
include_once 'classes/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

if ($_POST) {
    $comment->postId = $_POST['postId'];
    $comment->userId = 1; // Aquí deberías usar el ID del usuario autenticado
    $comment->content = $_POST['content'];

    if ($comment->create()) {
        echo "Comentario agregado exitosamente.";
    } else {
        echo "Error al agregar el comentario.";
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
    <form action="comment.php" method="post">
        <input type="hidden" name="postId" value="1"> <!-- Aquí deberías usar el ID de la publicación actual -->
        <textarea name="content" placeholder="Escribe tu comentario" required></textarea>
        <button type="submit">Comentar</button>
    </form>
</body>
</html>
