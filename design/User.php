<?php
require('config.php');
class User extends Dbconfig {	
    protected $hostName="127.0.0.1:3306";
    protected $userName="root";
    protected $password="password";
	protected $dbName="pool_php_rush";
	private $empTable="users";
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this->hostName = $database->serverName;
            $this->userName = $database->userName;
            $this->password = $database->password;
			$this->dbName = $database->dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}   	
	public function UserList(){		
		$sqlQuery = "SELECT * FROM ".$this->empTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR username LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR password LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR isAdmin LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		
		$numRows = mysqli_num_rows($result);
		$userData = array();	
		while( $user = mysqli_fetch_assoc($result) ) {		
			$empRows = array();			
			$empRows[] = $user['id'];
			$empRows[] = ucfirst($user['username']);
			$empRows[] = $user['password'];		
			$empRows[] = $user['email'];
			$empRows[] = $user['isAdmin'];					
			$empRows[] = '<button type="button" name="update" id="'.$user["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$empRows[] = '<button type="button" name="delete" id="'.$user["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$userData[] = $empRows;
		}
		
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$userData
		);
		echo json_encode($output);
	}
	public function getUser(){
		if($_POST["empid"]) {
			$sqlQuery = "
				SELECT * FROM ".$this->empTable." 
				WHERE id = '".$_POST["empid"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQL_ASSOC);
			echo json_encode($row);
		}
	}
	public function updateUser(){
		if($_POST['empid']) {	
			$updateQuery = "UPDATE ".$this->empTable." 
			SET name = '".$_POST["empusername"]."', email = '".$_POST["empmail"]."', password = '".$_POST["emppassword"]."', isAdmin = '".$_POST["empisAdmin"]."'"."'
			WHERE id ='".$_POST["empid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}
	public function addUser(){
		$insertQuery = "INSERT INTO ".$this->empTable." (username, email, password, isAdmin) VALUES ('".$_POST["empuserame"]."', '".$_POST["empemail"]."', '".$_POST["emppassword"]."', '".$_POST["empisAdmin"]."')";
		$isUpdated = mysqli_query($this->dbConnect, $insertQuery);		
	}
	public function deleteUser(){
		if($_POST["empid"]) {
			$sqlDelete = "
				DELETE FROM ".$this->empTable."
				WHERE id = '".$_POST["empid"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}
}
?>