<?php
include_once 'Connection.php';
$conn = new \core\Connection;
$arr = json_decode(file_get_contents('php://input'), true);
if(count($arr)==4){
    $response = $conn->chackData($arr);
}else if(count($arr)==2){
    $response = $conn->checkUser($arr);
}

echo json_encode($response);