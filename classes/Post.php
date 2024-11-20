<?php

class Post {
    private $conn;
    private $tableName = "posts";

    public $id;
    public $title;
    public $content;
    public $authorId;
    public $createdAt;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET title=:title, content=:content, image_path=:imagePath, author_id=:authorId, created_at=:createdAt";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->createdAt = date('Y-m-d H:i:s');

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            $this->imagePath = $targetFile;
        } else {
            $this->imagePath = null;
        }

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":imagePath", $this->imagePath);
        $stmt->bindParam(":authorId", $this->authorId);
        $stmt->bindParam(":createdAt", $this->createdAt);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Error creating post: " . $e->getMessage());
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT p.*, u.username as author FROM " . $this->tableName . " p JOIN users u ON p.author_id = u.id ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error reading all posts: " . $e->getMessage());
            return false;
        }
        return $stmt;
    }
    public function readSingle($id) {
        $query = "SELECT p.*, u.username as author FROM " . $this->tableName . " p JOIN users u ON p.author_id = u.id WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error reading single post: " . $e->getMessage());
            return false;
        }
    }

    public function update() {
        $query = "UPDATE " . $this->tableName . " SET title=:title, content=:content WHERE id=:id AND author_id=:authorId";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":authorId", $this->authorId);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Error updating post: " . $e->getMessage());
        }
        return false;
    }

    public function delete($id) {
        // Primero eliminar los comentarios asociados
        $queryComments = "DELETE FROM comments WHERE post_id = :id";
        $stmtComments = $this->conn->prepare($queryComments);
        $stmtComments->bindParam(':id', $id);
        try {
            $stmtComments->execute();
        } catch (PDOException $e) {
            error_log("Error deleting comments for post: " . $e->getMessage());
            return false;
        }

        // Luego eliminar la publicación
        $queryPost = "DELETE FROM " . $this->tableName . " WHERE id = :id AND author_id = :authorId";
        $stmtPost = $this->conn->prepare($queryPost);
        $stmtPost->bindParam(':id', $id);
        $stmtPost->bindParam(':authorId', $this->authorId);

        try {
            if ($stmtPost->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Error deleting post: " . $e->getMessage());
        }
        return false;
    }
}
?>
