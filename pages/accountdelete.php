<?php
   session_start();
   include "../includes/connect.php";
?>

<?php
     
	  $memberID=$_POST['memberID'];
	  
	  $sql="DELETE member.* FROM member WHERE memberID='$memberID'"; //delete the member details from both the login table and the member table
	  
	  $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
  
    //user messages
	$_SESSION['success']='Account deleted successfully';
	
	unset($_SESSION['member']);  //unset the member session that was registered during the login process when the account is deleted
	
	unset($_SESSION['user']); //unset the user session that was registered during the login process when the account is deleted
	 
	header('location:../index.php');

?>