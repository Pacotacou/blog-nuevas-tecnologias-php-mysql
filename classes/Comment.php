<?php

class Comment {
    private $conn;
    private $tableName = "comments";

    public $id;
    public $postId;
    public $userId;
    public $content;
    public $createdAt;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET post_id=:postId, user_id=:userId, content=:content, created_at=:createdAt";
        $stmt = $this->conn->prepare($query);

        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->createdAt = date('Y-m-d H:i:s');

        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":createdAt", $this->createdAt);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
