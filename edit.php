<?php
require_once "config/Database.php";
require_once "classes/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();

$mhs = new Mahasiswa($db);
$id = $_GET['id'];

$query = $db->prepare("SELECT * FROM mahasiswa WHERE id=:id");
$query->bindParam(":id", $id);
$query->execute();
$data = $query->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $mhs->id = $id;
    $mhs->nama = $_POST['nama'];
    $mhs->nim = $_POST['nim'];
    $mhs->jurusan = $_POST['jurusan'];

    if ($mhs->update()) {
    setcookie('success', 'edit', time() + 1);
    header("Location: index.php");
    exit();}
}
?>

<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
    NIM: <input type="text" name="nim" value="<?= $data['nim'] ?>"><br>
    Jurusan: <input type="text" name="jurusan" value="<?= $data['jurusan'] ?>"><br>
    <button type="submit">Update</button>
</form>