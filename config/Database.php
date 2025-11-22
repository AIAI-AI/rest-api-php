<?php
class Database {
    private $host = "localhost";
    private $db_name = "kampus";
    private $username = "root";
    private $password = "AisyahTech!2025";
    public $conn;

    public function getConnection() {
    $this->conn = null;
    try {
    $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,

    $this->username, $this->password);

    } catch (PDOException $e) {
    echo "Koneksi error: " . $e->getMessage();
    }
    return $this->conn;
    }
}
?>
