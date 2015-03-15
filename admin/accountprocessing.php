<?php 
   session_start(); 
   include "../includes/connect.php";
?>

<?php
   $adminID=$_POST['adminID']; //retrieve reviewID from hidden form field
	
	$username = mysqli_real_escape_string($con, $_POST['username']); //prevent SQL injection 
    
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']); 
	
	$lastName = mysqli_real_escape_string($con, $_POST['lastName']); 
	
	$email = mysqli_real_escape_string($con, $_POST['email']); 
	
	$sql="SELECT * FROM admin WHERE adminID='$adminID'"; //check if the username is taken
	
	$result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
	
	$row=mysqli_fetch_array($result);
	
	if($firstName==""||$lastName==""||$email=="" )//check if any required field is empty
	{
	    $_SESSION['error']='All *fields are required.';
         
         header("location:account.php"); //redirects to registration.php
        
         exit();
	}
  
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))  //check if email is valid
      {
         $_SESSION['error']='Please enter a valid email address.';
         
         header("location:account.php"); //redirects to registration.php
        
         exit();
      }
	  
	else
	{
	  $sql="UPDATE admin SET adminFname='$firstName', adminLname='$lastName', adminEmail='$email' WHERE adminID='$adminID'";
	  
	  $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
	  
	  $_SESSION['success']='Account updated successfully.'; //if new admin acnt is successful , initialises a session called 'success' with a message
        
        header("location:account.php"); //redirects to login page
	
	  
	}
?>