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

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT p.*, u.username as author FROM " . $this->tableName . " p JOIN users u ON p.author_id = u.id ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
