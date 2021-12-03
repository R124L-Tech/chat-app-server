<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate user object
$user = new Responden($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$user->contacts = $data;

// Get contacts
$user->readMatchContact();
echo json_encode($user->filteredContacts);
