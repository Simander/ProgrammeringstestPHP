<?php
	/*
	Validates input and writes user data to the database,
	using the DbAccess -class found in the DBAccess.php file.
	*/


	//defines variables and initialises with empty values
	$firstname = $lastname = $email = $password = "";
	$fnameErr = $lnameErr = $emailErr = $pwordErr = "";

	//if REQUEST_METHOD is HTTP POST, reads the input variables
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//if field is empty, sets the corresponding error variable
		if(empty($_POST["firstname"])){
			$fnameErr = "You must enter a firstname!";
		}
		else{
			$firstname = test_input($_POST["firstname"]);
			//using regex to check if the field contains anything but letters or whitespace
			if(!preg_match("/^[A-Åa-å ]*$/", $firstname)){
				//sets the corresponding error variable
				$fnameErr = "Firstname can only contain letters and whitespace!";
			}
		}
		//if field is empty, sets the corresponding error variable
		if(empty($_POST["lastname"])){
			$lnameErr = "You must enter a lastname!";
		}
		else{
			$lastname = test_input($_POST["lastname"]);
			//using regex to check if the field contains anything but letters or whitespace
			if(!preg_match("/^[A-Åa-å ]*$/", $lastname)){
				//sets the corresponding error variable
				$lnameErr = "Firstname can only contain letters and whitespace!";
			}
		}
		//if field is empty, sets the corresponding error variable
		if(empty($_POST["email"])){
			$emailErr = "You must enter a email address!";
		}
		else{
			$email = test_input($_POST["email"]);
			/*creates a new version of the email address received,
			and replaces æøå with a, then uses FILTER_VALIDATE_EMAIL,
			 to check if format is correct
			*/
			$testMail = str_replace(['Æ','Ø','Å','æ','ø','å'], 'a', $email);
			if(!filter_var($testMail, FILTER_VALIDATE_EMAIL)){
				$emailErr = "Invalid email format!";
			}
		}
		//if field is empty, sets the corresponding error variable
		if(empty($_POST["password"])){
			$pwordErr = "You must enter a password!";
		}
		else{
			$password = test_input($_POST["password"]);
			/*using regex to check that the password only contains letters and numbers,
			and is between 6 and 12 characters long*/
			if(!preg_match("/^[A-åa-å0-9]{6,12}$/", $password)){
				$pwordErr = "The password can only contain letters and numbers, and must be between 6 and 12 characters long!";
			}
			else{
				//makes a hash of the entered password
				$password = hash("sha256", $password);
			}			
		}
		//if no input related errors.
		if($pwordErr == "" && $emailErr == "" && $lnameErr == "" && $fnameErr == ""){
			//requires the User -class from User.php
			require_once 'Model/User.php';
			
			$user = new User($firstname, $lastname, $email,
				$password);
			
			//requires the DbAccess -class from DBAccess.php
			require_once 'Model/DBAccess.php';
			
			//Instantiates an object of the DbAccess -class
			$db = new DbAccess();
			
			/*calls the DbAccess -objects insertUser method
			and sends the $user -object as a parameter*/
			$db->insertUser($user);
		}

	}

	function test_input($data){
		//strips whitespace characters from the beginning or end of input string
		$data = trim($data);
		//removes slashes
		$data = stripslashes($data);
		//converts special characters to html entities.
		$data = htmlspecialchars($data);
		//returns the input string.
		return $data;
	}
?>