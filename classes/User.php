<?php

/**
 * Class User
 * Handles user registration and login functionalities.
 */
class User {
    private $conn;
    private $tableName = "users";

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Register a new user.
     * @return bool True on success, false on failure.
     */
    public function register() {
        $query = "INSERT INTO " . $this->tableName . " SET username=:username, email=:email, password=:password";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Error registering user: " . $e->getMessage());
        }
        return false;
    }

    /**
     * Log in a user.
     * @return bool True on success, false on failure.
     */
    public function login() {
        $query = "SELECT id, username, password FROM " . $this->tableName . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":email", $this->email);
        try {
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                return true;
            }
        } catch (PDOException $e) {
            error_log("Error logging in user: " . $e->getMessage());
        }
        return false;
    }
}
?>
