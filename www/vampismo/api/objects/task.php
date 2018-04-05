<?php
class Task{
 
    // database connection and table name
    private $conn;
    private $table_name = "tasks";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $created;
	public $template_id;
	public $template_name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


	// read tasks
	function read(){
	 
	    // select all query
	    $query = "SELECT
	                c.name as template_name, t.id, t.name, t.description, t.template_id, t.created
	            FROM
	                " . $this->table_name . " t
	                LEFT JOIN
	                    templates c
	                        ON t.template_id = c.id
	            ORDER BY
	                t.created DESC";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	 
	    // execute query
	    $stmt->execute();
	 
	    return $stmt;
	}

	// create task
	function create(){
 
	    // query to insert record
	    $query = "INSERT INTO
	                " . $this->table_name . "
	            SET
	                name=:name, description=:description, created=:created, template_id=:template_id";
	 
	    // prepare query
	    $stmt = $this->conn->prepare($query);
	 
	    // sanitize
	    $this->name=htmlspecialchars(strip_tags($this->name));
	    $this->description=htmlspecialchars(strip_tags($this->description));
	    $this->created=htmlspecialchars(strip_tags($this->created));
	    $this->template_id=htmlspecialchars(strip_tags($this->template_id));

	 
	    // bind values
	    $stmt->bindParam(":name", $this->name);
	    $stmt->bindParam(":description", $this->description);
	    $stmt->bindParam(":created", $this->created);
	    $stmt->bindParam(":template_id", $this->category_id);

	 
	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
     
	}

}
?>