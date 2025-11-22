<?php
class Mahasiswa {
    private $conn;
    private $table_name = "mahasiswa";

    public $id;
    public $nama;
    public $nim;
    public $jurusan;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . 
                " (nama, nim, jurusan) VALUES (:nama, :nim, :jurusan)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":jurusan", $this->jurusan);

        return $stmt->execute();
    }

    // READ
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . 
            " SET nama=:nama, nim=:nim, jurusan=:jurusan WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    } 
}
?>
