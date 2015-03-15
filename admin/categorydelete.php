<?php 
   session_start();
   include "../includes/connect.php"; 
?> 

<?php 
   $categoryID = $_GET['categoryID']; 
 
   $sql = "DELETE category.* FROM category WHERE categoryID = '$categoryID'"; //delete the member details from both the login table and the member table 
   
   $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query

   //user messages

   $_SESSION['success'] = 'Category deleted successfully.'; //register a session with a success message 
   
   header('location: categories.php') ; 
   
 ?>