<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../../config/Database.php";
include_once "../../models/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->nama) && !empty($data->nim) && !empty($data->jurusan)) {

// 🔍 Validasi NIM duplikat
$cek = $db->prepare("SELECT nim FROM mahasiswa WHERE nim = :nim");
$cek->bindParam(":nim", $data->nim);
$cek->execute();
if ($cek->rowCount() > 0) {
http_response_code(409); // Conflict

echo json_encode(["message" => "Gagal! NIM sudah digunakan."]);
exit;
}
// Jika unik, lakukan INSERT
$query = "INSERT INTO mahasiswa SET nama=:nama, nim=:nim, jurusan=:jurusan";
$stmt = $db->prepare($query);
$stmt->bindParam(":nama", $data->nama);
$stmt->bindParam(":nim", $data->nim);
$stmt->bindParam(":jurusan", $data->jurusan);

if ($stmt->execute()) {http_response_code(201);

echo json_encode(["message" => "Data mahasiswa berhasil ditambahkan.
"]);

} else {
http_response_code(503);

echo json_encode(["message" => "Gagal menambahkan data mahasiswa."]);
}
} else {
http_response_code(400);
echo json_encode(["message" => "Data tidak lengkap."]);}
?>