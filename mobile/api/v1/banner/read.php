<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Banner.php';

$database = new Database();
$db = $database->getConnection();
 
$banner = new Banner($db);


$result = $banner->read();

if($result){    
    http_response_code(200);     
    echo json_encode($result);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 
?>

