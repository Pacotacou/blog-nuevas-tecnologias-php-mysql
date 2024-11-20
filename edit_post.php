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

if ($_GET && isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postDetails = $post->readSingle($postId);

    if ($_POST) {
        $post->id = $postId;
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        
        // Manejar la carga de la imagen
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            $post->imagePath = $targetFile;
        } else {
            $post->imagePath = $postDetails['image_path']; // Mantener la imagen actual si no se carga una nueva
        }

        $post->authorId = $_SESSION['user_id'];

        if ($post->update()) {
            echo "<p style='color:green;'>Publicación actualizada exitosamente.</p>";
        } else {
            echo "<p style='color:red;'>Error al actualizar la publicación.</p>";
        }
    }
} else {
    echo "Publicación no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Publicación</title>
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <h1>Editar Publicación</h1>
        <form action="edit_post.php?id=<?php echo $postId; ?>" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($postDetails['title']); ?>" required>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" required><?php echo htmlspecialchars($postDetails['content']); ?></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
