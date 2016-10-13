<DOCTYPE html>
<html>
	<head>
		<title>Register User</title>
		<meta charset="UTF-8">
		
		<style>
			.table {
				border: 1px solid black;
			}
			.row{
				font-weight: bold;
			}
			.column{
				padding-right: 1em;
			}
		</style>
	</head>
	<body>
		<?php 
			require "Tools/InputValidation.php"; 
			require_once "Model/DBAccess.php";
			$db = new DbAccess();

			//Creates the database if it does not exist
			if($db->dbExists() == 0){
				$db->createDatabase();
			}
			/*Creates the table if it does not exist and the database,
			already exists*/
			if($db->dbExists()==1){
				if($db->tableExists() == 0){
					$db->createTable();
				}
			}


			?>
		<h2>Register User</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<table>
				<tr>
					<td>
						Firstname:
					</td>
					<td>
						<input type="text" name="firstname" placeholder="Ola">
					</td>
					<td>
						<span id="fnameErr" class="error" style="color:red">
							<?php echo $fnameErr;?>
						 </span>
					</td>
				<tr>
					<td>
						Lastname:
					</td>
					<td>
						<input type="text" name="lastname" placeholder="Nordmann">
					</td>
					<td>
						<span id="lnameErr" class="error" style="color:red">
							<?php echo $lnameErr;?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
						Email:
					</td>
					<td>
						<input type="text" name="email" placeholder="Ola@Nordmann.no">
					</td>
					<td>
						<span id="emailErr" class="error" style="color:red">
							<?php echo $emailErr;?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
						Password:
					</td>
					<td>
						<input type="password" name="password" placeholder="Password">
					</td>
					<td>
						<span id="pwordErr" class="error" style="color:red">
							<?php echo $pwordErr;?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<input type="submit" name="registerButton" value="Register">
					</td>
				</tr>
			</table>
			
		</form>
		<?php include "View/UsersList.php"; ?>
		
	</body>
</html>