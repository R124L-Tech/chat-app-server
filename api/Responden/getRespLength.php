<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Responden.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate responden object
$responden = new Responden($db);

// Get contacts
echo json_encode($responden->getRespLength());
