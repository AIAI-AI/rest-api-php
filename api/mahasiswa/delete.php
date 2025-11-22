<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../../config/Database.php";
include_once "../../models/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));
if (!empty($data->id)) {
$query = "DELETE FROM mahasiswa WHERE id=:id";
$stmt = $db->prepare($query);
$stmt->bindParam(":id"

, $data->id);

if ($stmt->execute()) {
http_response_code(200);
echo json_encode(["message" => "Data mahasiswa berhasil dihapus."]);
} else {
http_response_code(503);
echo json_encode(["message" => "Gagal menghapus data mahasiswa."]);
}} else {
http_response_code(400);
echo json_encode(["message" => "ID tidak ditemukan."]);
}
?>