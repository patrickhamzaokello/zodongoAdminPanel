<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../../../admin/config.php';
include_once '../Functions/FoodMenu.php';

$database = new Database();
$db = $database->getConnString();
 
$menus = new FoodMenu($db);

$menus->menu_id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $menus->readPage();

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


