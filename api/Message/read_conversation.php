<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Messages.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate message object
$message = new Message($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$message->user = $data->user;
$message->target = $data->target;

// Get contacts
echo json_encode($message->readConversation());
