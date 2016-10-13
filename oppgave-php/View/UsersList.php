<?php
/*
	This script reads a list of users from the MySql database,
	and displays them as a table.
*/

	//requires the DbAccess -class from DBAccess.php
	require_once "Model/DBAccess.php";
	$db = new DbAccess();
	$userlist = $db->selectAllUsers();
	echo "<h3>Registered users</h3>";
	echo "<table class='table'><tr class='row'><td>Id</td><td>firstname</td><td>lastname</td><td>email</td><td>passwordhash</td></tr>";

		//generates a table -row for each user in the array $userlist
		foreach($userlist as $usr){
			echo"<tr>
					<td class='column'>".$usr->getId()."</td>
					<td class='column'>".$usr->getFirstName()."</td>
					<td class='column'>".$usr->getLastName()."</td>
					<td class='column'>".$usr->getEmail()."</td>
					<td class='column'>".$usr->getPassword()."</td>
				</tr>";
		}
	echo "</table>";
?>