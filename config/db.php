<?php

class Database {
    private $host = "localhost";
    private $dbName = "blog2";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            error_log("Database connection error: " . $exception->getMessage());
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
