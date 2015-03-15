<?php
   session_start();
   include "../includes/connect.php";
?>

<?php
  $comment= mysqli_real_escape_string($con, $_POST['comment']); //prevent SQL injection
  
  $reviewID= $_POST['reviewID']; //retrieve the reviewID from the hidden form field
  $memberID= $_SESSION['user'];// retrieve the memberID from the $_SESSION created when the user logged in
  
  $sql="INSERT INTO comment (reviewID, memberID, commentDT, comment) VALUES ('$reviewID', '$memberID', NOW(), '$comment')";
  
  $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
  
  //user messages
  if($result)
  {
     $_SESSION['success']='Comment added successfully'; //register a session with a success message
	 
	 header("location:blogpost.php?reviewID=". $reviewID); //redirect to the full review page with the appropriate reviewID
  }
  
  else
  {
     $_SESSION['error']='An error has occurred. Comment not added.'; //register a session with a success message
	 
	 header("location:blogpost.php?reviewID=". $reviewID); //redirect to the full review page with the appropriate reviewID
  }
?>