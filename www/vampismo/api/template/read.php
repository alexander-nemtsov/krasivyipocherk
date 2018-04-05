<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/template.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$template = new Template($db);
 
// query products
$stmt = $template->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // templates array
    $templates_arr=array();
    $templates_arr["records"]=array();	
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $template_item=array(
            "id" => $id,
            "name" => $name,
            "text" => html_entity_decode($description)
        );
 
        array_push($templates_arr["records"], $template_item);
    }
 
    echo json_encode($templates_arr);
}
 
else{
    echo json_encode(
        array("message" => "No templates found.")
    );
}
?>