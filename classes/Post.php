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
        $query = "INSERT INTO " . $this->tableName . " SET title=:title, content=:content, author_id=:authorId, created_at=:createdAt";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->createdAt = date('Y-m-d H:i:s');

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":authorId", $this->authorId);
        $stmt->bindParam(":createdAt", $this->createdAt);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->tableName . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
