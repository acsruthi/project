<?php 
   session_start();
   include "../includes/connect.php"; 
?> 

<?php 
   $reviewID = $_GET['reviewID']; 
   
   $sql = "DELETE review.* FROM review WHERE reviewID = '$reviewID'"; //delete the member details from both the login table and the member table 
   
   $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query

   //user messages

   $_SESSION['success'] = 'Review deleted successfully.'; //register a session with a success message 
   
   header('location: reviews.php') ; 
 ?>