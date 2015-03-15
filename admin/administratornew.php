<?php
   $page="Administrators";
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
?>

<section id="content">
  
   <h1>Add New Administrator</h1>
   
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
   
   <form action="administratornewprocessing.php" method="post">
  
			<label>Username*</label> 
		   <input type="text" name="username" required /><br /></br>
		   
		   <label>Password*</label> 
		   <input type="password" name="password" required pattern=".{8,}" title="Password must be 8 characters or more" /><br/><br />
		   
			<label>Firstname*</label> 
		   <input type="text" name="firstName" required /><br /></br>
		   
			<label>Lastname*</label> 
		   <input type="text" name="lastName" required /><br /></br>
		   
			<label>Email*</label> 
		   <input type="email" name="email" required /><br /></br>
		   
			<p><input type="submit" name="newadministrator" value="Add New Administrator" /></p>
			
  </form>
 
</section> <!-- end content --> 
 
<?php 
   include '../includes/dashboardfooter.php'; 
?> 
  
  
  
  
  