<?php 
   session_start(); 
   include "../includes/connect.php";
 ?>
 
 <?php
    
	 $adminID=$_POST['adminID']; //retrieve reviewID from hidden form field
	 
	 $password = mysqli_real_escape_string($con, $_POST['password']); //prevent SQL injection
	 
	  if(strlen($password) <8) //check if the password is a minimum of 8 chars long
      {
         $_SESSION['error']='Password must be 8 characters or more.';
         
         header("location:account.php"); //redirects to account.php
        
         exit();
      }
	  
	   else{
	  
			   $salt=md5(uniqid(rand(),true)); //create a random salt value
			  
			   $password=hash('sha256',$password.$salt); //generate the hashed pw with the salt value
			   
			   $sql="UPDATE admin SET adminPword='$password', salt='$salt' WHERE adminID='$adminID'";
			   
			   $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
           }
		   
		   if($result)
		  {
		     $_SESSION['success']='Password updated successfully'; //if registration is successful , initialises a session called 'success' with a message
			 
			 header("location:account.php");
		  }
		  
		   else
		  {
		      $_SESSION['error']='An error occured. Password not updated';
         
              header("location:account.php"); //redirects to account.php
        
             exit();
		  }
		   
		  
		   
 ?>