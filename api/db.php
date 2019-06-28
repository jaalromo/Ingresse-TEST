<?php 
error_reporting(0);
	
	//variables used in order to stablish connection with the DATABASE
	$servername="localhost";
	$username="root";
	$password="DATABASE";
	$dbname = "testApi";

	// Create connection with MySQL DATABASE
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
		if ($conn->connect_error) {
    		die(json_encode(array("message"=>$conn->connect_error)));
		}

	//function to check whether an inserted ID already exsist in the DATABASE
	function checking($id,$connection){ //$id=ID to be checked, $connection=variable with the created DATABASE connection
		$sql = "SELECT * FROM users where id=".$id."";
		$result = $connection->query($sql);
		return $result->num_rows > 0;
	}

?>