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

// Get contacts
echo json_encode($jawaban->getJawaban());
