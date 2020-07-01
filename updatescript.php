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
			
			
			echo'<form method="POST" action="script.php">';
				echo'Username';
				echo'<input type="text"  id="username" name="username"/>';
				echo'<br>';
				echo'Password';
				echo'<input type="password" id="password" name="password"/>';
				echo'<br>';
               echo'<input type = "submit" value="Save Changes">';
			echo'</form>';
		}
		
		// login failed 
		else{
			print("Username or password is incorrect");
		}
	
?>


