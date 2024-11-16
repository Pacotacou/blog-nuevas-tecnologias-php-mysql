<?php
include_once 'config/db.php';
include_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->register()) {
        header("Location: login.php");
        exit;
    } else {
        echo "<p style='color:red;'>Error al registrar el usuario.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
