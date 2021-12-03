<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Jawaban.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate jawaban object
$jawaban = new Jawaban($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$jawaban->idResponden = $data->idResponden;
$jawaban->jawaban = $data->jawaban;
$jawaban->uploadJawaban();

// echo json_encode($data);

// Get contacts
// if ($jawaban->uploadJawaban()) {
//     echo ('✔ MESSAGE SEND SUCCESSFULLY!');
// } else {
//     echo ('FAILED TO SEND MESSAGE🚫');
// }
