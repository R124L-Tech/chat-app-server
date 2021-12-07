<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Responden.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate responden object
$responden = new Responden($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$responden->idResponden = $data->idResponden;
$responden->lelah = $data->lelah;
$responden->mengantuk = $data->mengantuk;

// update data
$responden->updateKondisi();
