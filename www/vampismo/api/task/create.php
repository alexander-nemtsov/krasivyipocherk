<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate task object
include_once '../objects/task.php';
 
$database = new Database();
$db = $database->getConnection();
 
$task = new Task($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set task property values
$task->name = $data->name;
$task->description = $data->description;
$task->created = date('Y-m-d H:i:s');
$task->template_id = $date->template_id;


// create the task
if($task->create()){
    echo '{';
        echo '"message": "Task was created."';
    echo '}';
}
 
// if unable to create the task, tell the user
else{
    echo '{';
        echo '"message": "Unable to create task."';
    echo '}';
}
?>