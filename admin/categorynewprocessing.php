<?php 
   session_start(); 
   include "../includes/connect.php";
?>

<?php

    $category = mysqli_real_escape_string($con, $_POST['category']); //prevent SQL injection 
    
    $description = mysqli_real_escape_string($con, $_POST['description']); 
    
	$sql="INSERT INTO category (categoryName, categoryDescription) VALUES ('$category','$description')";
	
	 $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
     
     $_SESSION['success'] = 'New category successfully added.'; //if new review is added successfully initialise a session called 'success' with a msg
     
     header("location:categories.php"); //redirect to categories.php
?>