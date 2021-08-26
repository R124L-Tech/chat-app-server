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
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$user->uid = $data->uid;
$user->username = $data->name;
$user->phone_number = $data->phoneNumber;
$user->profile_image = $data->img;

// Crete user
if ($user->create()) {
    echo json_encode(
        array('message' => 'User data updated!')
    );
} else {
    echo json_encode(
        array('message' => 'User data not updated!')
    );
}
