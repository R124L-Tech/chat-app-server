<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Lagu.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate lagu object
$lagu = new Lagu($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$lagu->topik1 = $data->topik1;
$lagu->topik2 = $data->topik2;
$lagu->topik3 = $data->topik3;

// Get contacts
echo json_encode($lagu->getJudulLagu());
