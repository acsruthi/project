<?php
   $page="Categories";
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
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
  
  <form action="categorynewprocessing.php" method="post">
  
    <label>Category*:</label> 
   <input type="text" name="category" required /><br /></br>
   
   <label>Description*:</label> <br /></br>
   <textarea rows="10" cols="60%" name="description" ></textarea><br />
   
    <p><input type="submit" name="categorynew" value="Add New Category" /></p>
	
  </form>
  
  </section> <!-- end content --> 
 
<?php 
   include '../includes/dashboardfooter.php'; 
?>