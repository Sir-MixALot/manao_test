<?php
ini_set('display_errors', '1');
include_once 'Connection.php';
$conn = new \core\Connection;
$arr = json_decode(file_get_contents('php://input'), true);
try{
    if(count($arr)==4){
        $conn->checkAndRegisterUser($arr);
    }else if(count($arr)==2){
        $conn->checkAndLoginUser($arr);
    }
    $response = [
        'hasError' => false,
        'login' => $arr['usr_login']
    ];

}
catch (\UserInterrException $e){
    $response = [
        'hasError' => true,
        'reason' => $e->getReason()
    ];
}


echo json_encode($response);