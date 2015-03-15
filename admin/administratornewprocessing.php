<?php 
   session_start(); 
   include "../includes/connect.php";
?>

<?php
   	
	$username = mysqli_real_escape_string($con, $_POST['username']); //prevent SQL injection 
    
    $password = mysqli_real_escape_string($con, $_POST['password']); 
	
	$firstName = mysqli_real_escape_string($con, $_POST['firstName']); 
	
	$lastName = mysqli_real_escape_string($con, $_POST['lastName']); 
	
	$email = mysqli_real_escape_string($con, $_POST['email']); 
    
	if(strlen($password) <8) //check if the password is a minimum of 8 chars long
      {
         $_SESSION['error']='Password must be 8 characters or more.';
         
         header("location:administratornew.php"); //redirects to registration.php
        
         exit();
      }
	  
	  $salt=md5(uniqid(rand(),true)); //create a random salt value
	  
	  $password=hash('sha256',$password.$salt); //generate the hashed pw with the salt value
	  
	  $sql="SELECT * FROM admin WHERE adminUname='$username'"; //check if the username is taken
	  
	  $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
  
      $numrow=mysqli_num_rows($result);  //count how many rows are returned
      
      if($numrow > 0) //if count >0
      {
         $_SESSION['error']='Username taken. Please retry.'; //if the username is taken initialise a session called 'error' with  a msg
         
         header("location:administratornew.php"); //redirects to registration.php
        
         exit();
		 
	  }
	  
	   elseif($username==""||$password==""||$firstName==""||$lastName==""||$email=="" )//check if any required field is empty
      {
         $_SESSION['error']='All *fields are required.';
         
         header("location:administratornew.php"); //redirects to registration.php
        
         exit();
      }
	  
	  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))  //check if email is valid
      {
         $_SESSION['error']='Please enter a valid email address.';
         
         header("location:registration.php"); //redirects to registration.php
        
         exit();
      }
      
	  else
	  {
	     $sql="INSERT INTO admin(adminUname,adminPword,salt,adminFname,adminLname,adminEmail,adminJoinD,acntTypeID) VALUES ('$username', '$password', '$salt', '$firstName', '$lastName','$email', NOW(), '1')";
		 
		 $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
        
        $_SESSION['success']='You created a new administrator account.'; //if new admin acnt is successful , initialises a session called 'success' with a message
        
        header("location:administrators.php"); //redirects to login page
	  }
	  
	  
	  
?>