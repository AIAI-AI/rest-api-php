<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../../config/Database.php";
include_once "../../models/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));
if (!empty($data->id) && !empty($data->nama) && !empty($data->nim) &&
!empty($data->jurusan)) {
$mahasiswa->id = $data->id;
$mahasiswa->nama = $data->nama;
$mahasiswa->nim = $data->nim;
$mahasiswa->jurusan = $data->jurusan;
$query = "UPDATE mahasiswa SET nama=:nama, nim=:nim, jurusan=:jurusan WHERE
id=:id";
$stmt = $db->prepare($query);
$stmt->bindParam(":nama"

, $mahasiswa->nama);

$stmt->bindParam(":nim"

, $mahasiswa->nim);

$stmt->bindParam(":jurusan"

, $mahasiswa->jurusan);

$stmt->bindParam(":id"

, $mahasiswa->id);
if ($stmt->execute()) {

http_response_code(200);

echo json_encode(["message" => "Data mahasiswa berhasil diperbarui."]);

} else {
http_response_code(503);

echo json_encode(["message" => "Gagal memperbarui data mahasiswa.
"]);
}
} else {
http_response_code(400);

echo json_encode(["message" => "Data tidak lengkap.
"]);}
?>