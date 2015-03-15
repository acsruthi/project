<?php 
   session_start(); 
   include "../includes/connect.php";
 ?>
 
 <?php 
    $reviewID = $_POST['reviewID']; //retrieve reviewID from hidden form field
     
    $title = mysqli_real_escape_string($con, $_POST['title']); //prevent SQL injection 
    
    $content = mysqli_real_escape_string($con, $_POST['content']); 
    
    $adminID = mysqli_real_escape_string($con, $_POST['adminID']); 
    
    $categoryID = mysqli_real_escape_string($con, $_POST['categoryID']); 
    
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    
    $sql="UPDATE review SET reviewTitle='$title', reviewContent='$content', reviewDT=NOW(), adminID='$adminID', categoryID='$categoryID', reviewRating='$rating' WHERE reviewID='$reviewID'";
    
    $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
     
     $_SESSION['success'] = 'Review  updated successfully.'; //if new review is added successfully initialise a session called 'success' with a msg
     
     header("location:reviewupdate.php?reviewID=" . $reviewID); //redirect to reviewupdate.php
      
?>
      