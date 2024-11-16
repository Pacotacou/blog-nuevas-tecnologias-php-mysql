<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: post.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
