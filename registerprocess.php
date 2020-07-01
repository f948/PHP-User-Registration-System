<?php
		 
         // define variables and set to empty values
         $error_messages="";
		 $username=trim($_POST["username"]);
		 $password= trim($_POST["password"]);
		 $confirm_password=trim($_POST["confirm_password"]);
		
		 $num_lowercase=$num_uppercase=$num_special_char=$num_int=0;
         $i=0;
		
		 // check if username is empty
         if (empty($username)) {
			$error_messages.="Username cannot be empty"."<br>";
		 }
		 
		 // check if password is empty
		  if (empty($password)) {
			$error_messages.="Password cannot be empty"."<br>";
		 }
		
		 // check pasword content 
		 for($i=0;$i<=strlen($password)-1;$i++){
			
			if(strpos("abcdefghijklmnoqrstuvwxyz",$password[$i]) !==false){
				$num_lowercase++;
			}
			
			if( strpos("ABCDEFGHIJKLMNOQRSTUVWXYZ",$password[$i]) !==false){
				$num_uppercase++;
			}
			
			if( strpos("!@#$%^&*()",$password[$i]) !==false){
				$num_special_char++;
			}
			
			if( strpos("1234567890",$password[$i])!==false){
				$num_int++;
			}
		 }
		 
		 if($num_lowercase == 0 && !empty($password)){
			$error_messages.="At least one character must be lowercase in password"."<br>";
		 }
		 if($num_uppercase==0 && !empty($password)){
			$error_messages.="At least one character must be uppercase in password"."<br>";
		}
		if($num_special_char==0 && !empty($password)){
			$error_messages.="At least one character must be a special character in password"."<br>";
		}
		if($num_int==0 && !empty($password)){
			$error_messages.="At least one character must be an integer in password"."<br>";
		}
        
		if(strlen($password) <8){
			$error_messages.="Password must be at least 8 characters long".'\n';
		}
	
		// check if username and password are not taken
		 
		 // connect to database 
		$conn=mysqli_connect("localhost","root","","users");
		$command = "SELECT * FROM users WHERE username = '$username' OR password = '$password'";
		$query = mysqli_query($conn,$command);
		$row = mysqli_fetch_array($query);
		
		if($row["username"] == $username){
			$error_messages.="Username is already taken"."<br>";
		}
		
		if($row["password"] == $password){
			$error_messages.="Password is already taken"."<br>";
		}
		
		if($password != $confirm_password && !empty($password)){
			$error_messages.="Password and confirmation password must be the same"."<br>";
		}
		
				
		// if there are no error messages register user in mySQL database 
		if($error_messages == ""){
			
			// connect to database 
		    $conn=mysqli_connect("localhost","root","","users");
			
			// connection failed 
			if(!$conn){
				die("Could not connect to database: " . mysqli_error($conn));
			}
		
			$command = "INSERT INTO `users`(`username`, `password`) VALUES ('$username','$password')";
	  
			$query = mysqli_query($conn,$command);
			
			// query failed 
			if(! $query ) {
				die('Could not insert data: ' . mysqli_error($conn));
				
			}
			
			print("You are now a registered user");
			
		}
		
		// show error messages 
		else{
			print("<p>".$error_messages."</p>");
		}
		
		
?>

<html>   
   <body>
		<form method="POST" action="registerprocess.php">
			Username 
			<input type="text"  id="username" name="username"/>
			<br>
			Password
			<input type="password" id="password" name="password"/>
			<br>
			Confirm Password
			<input type="password" id="confirm_password" name="confirm_password"/>
			<br>
            <input type = "submit" value="Register">
		</form>
   </body> 
</html>