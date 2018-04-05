<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate template object
include_once '../objects/template.php';
 
$database = new Database();
$db = $database->getConnection();
 
$template = new Template($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set template property values
$template->name = $data->name;
$template->text = $data->text;

 
// create the template
if($product->create()){
    echo '{';
        echo '"message": "Template was created."';
    echo '}';
}
 
// if unable to create the template, tell the user
else{
    echo '{';
        echo '"message": "Unable to create template."';
    echo '}';
}
?>