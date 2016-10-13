<?php
	//This class represents a user
	class User{
		private $id;
		private $firstname;
		private $lastname;
		private $email;
		private $password;

		//Constructor
		public function __construct($firstname, $lastname, $email, $password){
			$this->firstname = $firstname;
			$this->lastname = $lastname;
			$this->email = $email;
			$this->password = $password;
		}

		//returns the user id
		public function getId(){
			return $this->id;
		}

		//sets the user id
		public function setId($id){
			$this->id = $id;
		}

		//returns the users first name
		public function getFirstName(){
			return $this->firstname;
		}

		//sets the users first name
		public function setFirstName($firstname){
			$this->firstname = $firstname;
		}

		//returns the users last name
		public function getLastName(){
			return $this->lastname;
		}

		//sets the users last name
		public function setLastName($lastname){
			$this->lastname = $lastname;
		}

		//returns the users email
		public function getEmail(){
			return $this->email;
		}

		//sets the users email
		public function setEmail($email){
			$this->email = $email;
		}

		//returns the users password
		public function getPassword(){
			return $this->password;
		}

		//sets the users password
		public function setPassword($password){
			$this->password = $password;
		}

		public function toString(){
			return "Name: ".$this->firstname." ".$this->lastname.
			"<br>Email: ".$this->email."<br>PasswordHash: ".$this->password;
		}

	}
?>