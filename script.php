<?php
		// get variables values 
		$error_messages="";
		$username=trim($_POST["username"]);
		$password= trim($_POST["password"]);
	
		
		$num_lowercase=$num_uppercase=$num_special_char=$num_int=0;
		
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
			
			if( strpos("abcdefghijklmnoqrstuvwxyz",$password[$i]) !=false){
				$num_lowercase++;
			}
			
			if( strpos("ABCDEFGHIJKLMNOQRSTUVWXYZ",$password[$i]) !=false){
				$num_uppercase++;
			}
			
			if( strpos("!@#$%^&*()",$password[$i]) !=false){
				$num_special_char++;
			}
			
			if( strpos("1234567890",$password[$i])!=false){
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
		
		if($error_messages==""){
		
			// connect to database 
			$conn=mysqli_connect("localhost","root","","users");
			
			// connection failed 
			if(!$conn){
				die("Could not connect to database: " . mysqli_error($conn));
			}
			
			$command = "UPDATE users SET `username`= '$username'WHERE `username`='$username'";
			$query = mysqli_query($conn,$command);
			
			$command2 = "UPDATE users SET`password`='$password'WHERE `username`='$username'";
			$query2 = mysqli_query($conn,$command2);
			
			// query failed 
			if( !$query || !$query2 ) {
				die('Could not retrieve data: ' . mysqli_error($conn));
			}
			
			print("Changes made");
		}
		
		// show error messages 
		else{
			print("<p>".$error_messages."</p>");
		}
			
?>
			
	