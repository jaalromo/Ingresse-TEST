<?php
include_once 'db.php';   //to be able to communicate with the database
include_once 'user.php'; //to include the "user" class



//Check what's the request method used in order to take action according to it
if($_SERVER['REQUEST_METHOD']=='POST'){ //if the POST method is used
	foreach ($_POST as $data) { //
		if($data=='') die(json_encode(array("message"=>'empty values are not allowed')));
	}

	if (checking($_POST['id'],$conn)) {
		echo json_encode(array("message"=>"A record with this ID already exists"));
	}else{
		$stmt = $conn->prepare("INSERT INTO users (name, lastname, age, profession, id, address, nationality, marital_status, birthday) VALUES (?,?,?,?,?,?,?,?,?)");
	
		$stmt->bind_param("sssssssss", $_POST['name'], $_POST['lastname'], $_POST['age'],$_POST['profession'],$_POST['id'],$_POST['address'],$_POST['nationality'],$_POST['m_status'],$_POST['birthday']);

		$stmt->execute();
		$stmt->close();

		echo json_encode(array("message"=>"New record successfully created","name"=>$_POST['name'], "lastname"=>$_POST['lastname'], "age"=>$_POST['age'],"profession"=>$_POST['profession'],"id"=>$_POST['id'],"address"=>$_POST['address'],"nationality"=>$_POST['nationality'],"m_status"=>$_POST['m_status'],"birthday"=>$_POST['birthday']));
	}
}

elseif ($_SERVER['REQUEST_METHOD']=='GET') { //if the GET method is used
	
	$user= new user();

	$sql = "SELECT * FROM users where id=".$_GET['id']."";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
    	$row = $result->fetch_assoc(); 
        	$user->name=$row['name'];
        	$user->lastname=$row['lastname'];
        	$user->age=$row['age'];
        	$user->profession=$row['profession'];
        	$user->id_Number=$row['id'];
        	$user->address=$row['address'];
        	$user->marital_status=$row['marital_status'];
        	$user->nationality=$row['nationality'];
        	$user->birthday=$row['birthday'];

        	echo json_encode($user);
    }else{
    	echo json_encode(array("message"=>"Such ID isn't registered"));
    }
}

elseif ($_SERVER['REQUEST_METHOD']=='PUT') { //if the PUT method is used
	parse_str(file_get_contents("php://input"),$put_vars); //retrieving data sent by the client
	
	if (checking($put_vars['id'],$conn)) {

		$mod_var='';
		foreach ($put_vars as $key => $value) {
			if($key=='id') continue;
			$mod_var.="".$key."='".$value."',";
		}

		$sql = "UPDATE users SET ".substr($mod_var, 0, -1)." WHERE id=".$put_vars['id']."";

		if ($conn->query($sql) === TRUE) {
			$user= new user();

			$sql = "SELECT * FROM users where id=".$put_vars['id']."";
			$result = $conn->query($sql);

			$row = $result->fetch_assoc(); 
        	$user->name=$row['name'];
        	$user->lastname=$row['lastname'];
        	$user->age=$row['age'];
        	$user->profession=$row['profession'];
        	$user->id_Number=$row['id'];
        	$user->address=$row['address'];
        	$user->marital_status=$row['marital_status'];
        	$user->nationality=$row['nationality'];
        	$user->birthday=$row['birthday'];

    		echo json_encode(array("message"=>"Record successfully updated","user"=>$user));
		} else {
    		echo json_encode(array("message"=>"Error updating record"));
    	}
	}else{
		echo json_encode(array("message"=>"The selected ID doesn't exist"));
	}
}

elseif ($_SERVER['REQUEST_METHOD']=='DELETE') { //if the DELETE method is used
	parse_str(file_get_contents("php://input"),$del_var); //retrieving data sent by the client
	
	if (checking($del_var['id'],$conn)) { 

		// sql to delete a record
		$sql = "DELETE FROM users where id=".$del_var['id']."";
		if ($conn->query($sql) === TRUE) {
    		echo json_encode(array("message"=>"Record successfully deleted"));
		} else {
   			echo json_encode(array("message"=>"Error deleting record"));
		}

	}else{
		echo json_encode(array("message"=>"The selected ID doesn't exist"));
	}
}

$conn->close();
?>