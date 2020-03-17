<?php

session_start();

if(isset($_POST['submit'])){

	include 'main-db-connection.php';
	$uid= mysqli_real_escape_string($conn, $_POST['email']); //mysqli_real_escape_string() makes sure that people do not type in any malicious code inside.
	$pwd= mysqli_real_escape_string($conn, $_POST['paswd']);

	//Error handlers
	//Check if inputs are empty
	if(empty($uid) || empty($pwd)){
         header("Location: login.php?login=empty");
	     exit();
	}else{
		 //using prepared statements
		$sql= "SELECT * FROM tutors WHERE email=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
    			echo "SQL error!";
        }else{
        	$data = Array();
    		mysqli_stmt_bind_param($stmt, "s", $uid);
    		mysqli_stmt_execute($stmt);
    		$result=mysqli_stmt_get_result($stmt);
    		while($row=mysqli_fetch_assoc($result)){
    			$data[] = $row;
    		  }
              if(0==count($data)){
    		    header("Location: login.php?login=nosuchuser");
    		    exit();
              }else{
              	mysqli_stmt_bind_param($stmt, "s", $uid);
    		    mysqli_stmt_execute($stmt);
    		    $result=mysqli_stmt_get_result($stmt);
    		    while($row=mysqli_fetch_assoc($result)){
    		      //De-hashing the password
			     $hashedPwdCheck= password_verify($pwd, $row['paswd']); //matching the database password with the password entered by the user using inbuilt password_verify().
					echo "hashedPwdCheck";
		         if($hashedPwdCheck == false){
		    	  header("Location: login.php?login=incorrectpass");
	              exit();
		         }elseif($hashedPwdCheck == true){
		    	//Log in the user here
		    	$_SESSION['u_email'] = $row['email'];
		    	$_SESSION['u_pwd'] = $row['paswd'];
		    	header("Location: ./tutorprofile.html?login=success");
	            exit();
		      }
		     } 
		   }
	    }
	  }
}else{
	header("Location: login.php?login=error");
	exit();
}