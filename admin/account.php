<?php
   $page="My Account";
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
?>

<?php  
  
   $adminID=$_SESSION['user']; //retrieve the adminID from the current session
   
   $sql="SELECT * FROM admin WHERE adminID='$adminID'";
   
   $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
  
   $row=mysqli_fetch_array($result); 
?>

<section id="content">

   <?php
       //user messages
       
       if(isset($_SESSION['error'])) 
       {
          echo '<div class="error">';
          echo '<p>'.$_SESSION['error'].'</p>';
          echo '</div>';
          unset($_SESSION['error']); //unset session error
       }
       
       elseif(isset($_SESSION['success']))
       {
          echo '<div class="success">';
          echo '<p>'.$_SESSION['success'].'</p>';
          echo '</div>';
          unset($_SESSION['success']); //unset session error
       }
    ?>
	
	 <h1>Add New Category</h1>
	 
	 <p>Update your account details</p>
	 
	 <form action="accountprocessing.php" method="post">
	 
	    <label>Username*:</label> <input type="text" name="username" required value="<?php echo $row['adminUname'] ?>" readonly /> <br/><br/>
		
		<p><em><strong>Username cannot be updated.</strong></em></p>		   	
			
		   <label>First Name*:</label> <input type="text" name="firstName" required value="<?php echo $row['adminFname'] ?>"/> <br/><br/>
		   
		   <label>Last Name*:</label> <input type="text" name="lastName" required value="<?php echo $row['adminLname'] ?>"/> <br/><br/>
		   
		   <label>Email*:</label> <input type="text" name="email" required value="<?php echo $row['adminEmail'] ?>"/> <br/><br/>
		   
		    <input type="hidden" name="adminID" value="<?php echo $adminID; ?>" />
			
			<p><input type="submit" name="accountupdate" value="Update Account" /></p>
		   
	 </form>	</br>
	 
	 <h1>Update Password</h1>
	 
		<P>Passwords must  have a minimum of 8 characters .</p>
		
		<form action="accountpasswordprocessing.php" method="post"> 
		    
            <label>New Password:*</label> <input type="password" name="password" pattern=".{8,}" title="Password must be 8 characters or more" required /><br/>
			
			<input type="hidden" name="adminID" value="<?php echo $adminID; ?>"> </br>
			
			<input type="submit" name="passwordupdate" value="Update Password" />
		   
		</form>	</br>
		
 </section> <!-- end content --> 
 
<?php 
   include '../includes/dashboardfooter.php'; 
?>
		
	 
	 
	 
	 
	 
	    