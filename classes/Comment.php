<?php

/**
 * Class Comment
 * Manages comment creation and retrieval.
 */
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

    /**
     * Create a new comment.
     * @return bool True on success, false on failure.
     */
    public function create() {
        $query = "INSERT INTO " . $this->tableName . " SET post_id=:postId, user_id=:userId, content=:content, created_at=:createdAt";
        $stmt = $this->conn->prepare($query);

        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->createdAt = date('Y-m-d H:i:s');

        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":createdAt", $this->createdAt);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Error creating comment: " . $e->getMessage());
        }
        return false;
    }
    /**
     * Retrieve comments by post ID.
     * @param int $postId
     * @return PDOStatement|false
     */
    public function readByPostId($postId) {
        $query = "SELECT c.*, u.username FROM " . $this->tableName . " c JOIN users u ON c.user_id = u.id WHERE c.post_id = :postId ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':postId', $postId);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error reading comments by post ID: " . $e->getMessage());
            return false;
        }
        return $stmt;
    }
}
?>
