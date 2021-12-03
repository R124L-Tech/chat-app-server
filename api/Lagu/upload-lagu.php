<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Lagu.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate inputs object
$lagu = new Lagu($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$lagu->dataLagu = $data;
$lagu->upload();
echo ('✔ DATA SUCCESSFULLY UPLOAD');
