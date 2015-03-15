<?php
    session_start();
  	include '../includes/connect.php';
 ?>
 
 <?php
    if(!isset($_SESSION['admin']))
	{
	   header('location:../reviewHome.php');  //if the admin session is not set, redirect to the index page
	}
  
 ?> 