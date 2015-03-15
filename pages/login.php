<?php
    $page="Login";
	session_start();
	include '../includes/connect.php';
	include '../includes/header.php';
    include '../includes/nav.php';    
 ?>
 
 <section id="content">
 
    <h1>Welcome</h1>
	<p>We are happy to see you return! Please login to continue.</p></br>
	
	<?php
	  //user message
	  if(isset($_SESSION['error'])) //if session error is set
	  {
	    echo '<div class="error">';
		echo '<p>'.$_SESSION['error'].'</p>';//display error message
		echo "</div>";
		unset($_SESSION['error']); //unset session error
  	  }
	?>
    
    <?php
    if(isset($_SESSION['success']))
     {
       echo '<p id="success"><i>'.$_SESSION['success']."</i></p>";//if LOGIN successfully,a success msg will be displayed
	   unset($_SESSION['success']); 
     }
?>
	
	<form action="loginprocessing.php" method="post">
	   <label>Username:</label> <input type="text" name="username" id="username" placeholder="Enter your username" required /> <br/><br/>
	   
	    <label>Password:</label><input type="password" name="password" id="password" placeholder="Enter your password" required /> <br/>
	   
	   <input type="hidden" value="<?php echo $_GET['reviewID']; ?>" name="reviewID" /></br>
	   
	   <p><input type="submit" name="login" value="Login" /></p>
	</form></br>
	<p>Don't have an account yet? Please <a href="registration.php"> Sign up</a></p></br></br>
	
</section> <!--end content-->

<?php
    include "../includes/footer.php";
?>
	
	
	