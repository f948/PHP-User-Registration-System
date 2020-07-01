<?php
		 
        // define variables and set to empty values
		$username=trim($_POST["username"]);
		$password= trim($_POST["password"]);
	
		 // connect to database 
		$conn=mysqli_connect("localhost","root","","users");
		
		// connection failed 
		if(!$conn){
			die("Could not connect to database: " . mysqli_error($conn));
		}
		
		$command = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

		$query = mysqli_query($conn,$command);
		
		// query failed 
		if(! $query ) {
			die('Could not retrieve data: ' . mysqli_error($conn));
		}
		
		$row = mysqli_fetch_array($query);
		
		// login suceussful
		if($row["username"] == $username && $row["password"] == $password){
			print("Login suceussful"."<br>"."<br>");
			
			echo'<form method="POST" action="update.php">';
				echo'<table>';
			
					echo'<tr>';
						echo'<td'.'id="username" name="username"'.'>'.'Username: '.$row["username"].'</td>'.'<br>';
					echo'</tr>';
				
					echo'<tr>';
						echo'<td'.'id="password" name="password"'.'>'.'Password: '.$row["password"].'</td>'.'<br>';
					echo'</tr>';
				
				echo'</table>'.'<br>';
				
				echo'<input type="submit" value="Update">';
			echo'</form>';
		}
		
		// login failed 
		else{
			print("Username or password is incorrect");
		}
	
?>




