<?php
$con=mysqli_connect("localhost","root","","wdb2_candoth_4103752811");
  //check the connection and, if broken display an error message
  if(mysqli_connect_errno($con))
  {
    echo "Unable to connect to the server:".mysqli_connect_error();
	exit();
  }
?>
