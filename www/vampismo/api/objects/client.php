<?
class Client {

    // database connection and table name
    private $conn;
    private $table_name = "clients";
 
    // object properties
    public $id;
    public $name;
		
	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	
}
?>