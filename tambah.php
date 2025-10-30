<?php
require_once "config/Database.php";
require_once "classes/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();

$mhs = new Mahasiswa($db);

if ($_POST) {
    $mhs->nama = $_POST['nama'];
    $mhs->nim = $_POST['nim'];
    $mhs->jurusan = $_POST['jurusan'];

    if ($mhs->create()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambah data.";
    }
}
?>

<form method="POST">
    Nama: <input type="text" name="nama" required><br>
    NIM: <input type="text" name="nim" required><br>
    Jurusan: <input type="text" name="jurusan" required><br>
    <button type="submit">Simpan</button>
</form>
