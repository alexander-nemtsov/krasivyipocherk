<?php
class Template{
 
    // database connection and table name
    private $conn;
    private $table_name = "templates";
 
    // object properties
    public $id;
    public $name;
	public $text;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

}
?>