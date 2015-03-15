<?php
  	include '../includes/connect.php';
 ?>
 
 <?php
    if(!isset($_SESSION['admin']))
	{
	   header('location:../pages/reviewHome.php');  //if the admin session is not set, redirect to the front end index.php
	}
  
 ?>