<?php
require_once "config/Database.php";
require_once "classes/Mahasiswa.php";

//Instansiasi class Database
$db = new Database();
//Instansiasi class Mahasiswa
$mhs = new Mahasiswa($db->getConnection());
$data = $mhs->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="tambah.php">Tambah Data</a><br><br>
    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> 
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>