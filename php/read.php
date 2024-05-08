<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Acces-Control-Allow-Headers, Authorization, X-Requested-With');

$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod == 'GET') {
    $message = 'Successful';
}else{
    $data = $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed', 
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>