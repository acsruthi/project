<?php
   session_start(); 
   include "../includes/connect.php";
?>

<?php 

   $themeID = $_POST['themeID']; //retrieve the themeID from the hidden form field 
   
   $sql = "UPDATE current SET themeID = '$themeID'"; //update themeID in the current table 
   
   $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
   
   //user messages 
   
   $_SESSION['success'] = 'Theme updated successfully.'; //register a session with a success message 
   
   header('location: themes.php') ; 
?>