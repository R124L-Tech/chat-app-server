<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

$response = array();
$upload_dir = 'profile/';
$server_url = 'http://localhost/course/chat-app/server/api/User';

if ($_FILES['profile']) {
    $profile_name = $_FILES["profile"]["name"];
    $profile_tmp_name = $_FILES["profile"]["tmp_name"];
    $error = $_FILES["profile"]["error"];

    if ($error > 0) {
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    } else {
        $random_name = date("YdmHis") . rand(1000, 100000) . substr($profile_name, -5);
        $upload_name = $upload_dir . strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        if (move_uploaded_file($profile_tmp_name, $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "url" => $server_url . "/" . $upload_name,
                "img" => $random_name
            );
        } else {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
        }
    }
} else {
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No file was sent!"
    );
}

echo json_encode($response);
