<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$phone = $_POST['phone'];
$address = $_POST['address'];
$base64image = $_POST['image'];

$sqlinsert = "INSERT INTO tbl_users (user_name,user_email,user_phone,user_address,user_password,user_image) VALUES('$name','$email','$phone','$address','$password','$base64image')";
if ($conn->query($sqlinsert) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
    $filename = mysql_insert_id($conn);
    $decoded_string = base64_decode($base64image);
    $path = '../assets/images/' . $filename. '.png';
    $is_written = file_put_contents($path, $decoded_string);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

function sendEmail($email)
{
    //send email function here
}
?>