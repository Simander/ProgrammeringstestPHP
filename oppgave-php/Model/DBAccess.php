<?php
	/*
	This class contains various methods for creating a database,
	and a table, inserting a user into the table, and selecting all
	users found in the table.
	*/

	class DbAccess{
		//Database-connection related variables
		private $servername = "localhost";
		private $username = "testbruker";
		private $password = "password";
		private $dbname = "users";
		private $tablename ="Users";

	
		//Returns 1 if the database exists, 0 if not.
		function dbExists(){
			//establishing a connection to the database
			$connection = new mysqli($this->servername, $this->username, $this->password);
			//Check connection
			if($connection->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
			} 
			//sql query
			$sql = "SHOW DATABASES LIKE '$this->dbname'";
			//result of the query above
			$result = $connection->query($sql);
			//database exists
			if($result->num_rows > 0){
				$connection->close();
				return 1;
			}
			//database does not exist
			else{
				$connection->close();
				return 0;
			}
		}

		//function for creating a database, and a table for storing users
		function createDatabase(){
			//establishing a connection to the database
			$connection = new mysqli($this->servername, $this->username, $this->password);

			//sql query
			$sql = "CREATE DATABASE users";
			//if query is sent successfully
			if($connection->query($sql) === TRUE){
				echo "Database created successfully<br>"; 
			}
			else{
				echo "Error creating database: ".$connection->error."<br>";
			}

			$connection->close();
		}
		//Returns 1 if the table already exists, 0 if not.
		function tableExists(){
			//establishing a connection to the database
			$connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			// Check connection
			if ($connection->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SHOW TABLES LIKE '$this->tablename'";
			$result = $connection->query($sql);
			//table exists
			if($result->num_rows > 0){
				//closes the connection to the database
				$connection->close();
				return 1;
			}
			//table does not exist
			else{
				//closes the connection to the database
				$connection->close();
				return 0;
			}
		}
		//Creates a table for storing the users
		function createTable(){
			//Establishes a connection to the database
			$connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			
			//sql query
			$sql = "CREATE TABLE ".$this->tablename."(
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				email VARCHAR(50) NOT NULL,
				password BINARY(32) NOT NULL)";
			
			if($connection->query($sql)===TRUE){
				echo "Table Users successfully created!<br>";
			}
			else{
				echo "Error creating table: ".$connection->error."<br>";
			}
			//closes the connection to the database
			$connection->close();
		}
	
		public function insertUser($user){
			//reads the values from the incoming user-object
			$firstname = $user->getFirstName();
			$lastname = $user->getLastName();
			$email = $user->getEmail();
			$password = $user->getPassword();

			//Establishes a connection to the database
			$connection = new mysqli($this->servername, $this->username, 
			$this->password, $this->dbname);

			//checks the connection
			if($connection->connect_error){
				die("Connection failed: ".$connection->connect_error);
			}
			
			//sql query
			$sql = "INSERT INTO Users  (firstname, lastname, email, password)
				VALUES ('$firstname', '$lastname',
				'$email', '$password')";

			if($connection->query($sql)===TRUE){
				echo "User successfully added to the database!";
			}
			else{
				echo "Error: ".$sql."<br>".$connection->error;
			}
			//closes the connection to the database
			$connection->close();
		}

		public function selectAllUsers(){
			//requires the user class from User.php
			require_once "User.php";
			//A array to hold objects for each user in the database
			$users = array();
			//Establishes a connection to the database
			$connection = new mysqli($this->servername, $this->username, 
			$this->password, $this->dbname);

			//checks the connection
			if($connection->connect_error){
				die("Connection failed: ".$connection->connect_error);
			}

			//A sql query that selects all users from the Users table.
			$sql = "SELECT id, firstname, lastname, email, password FROM Users";
				$result = $connection->query($sql);
			
			//If the result has 1 or more rows
			if($result->num_rows > 0){
				//loops through the rows in the result
				while($row = $result->fetch_assoc()){
					//creates user objects from the database data
					$usr = new User($row["firstname"], $row["lastname"],
						$row["email"], $row["password"]);
					//sets the id for the user object to the db entry id.
					$usr->setId($row["id"]);
					//pushes the user-object onto the users array
					array_push($users, $usr);
				}
			}
			//closes the connection to the database
			$connection->close();
			//returns the array of users
			return $users;
		}

	}
?>