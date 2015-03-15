<?php
   $page="Categories";
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
?>

<?php
   $categoryID=$_GET['categoryID']; //retrieve reviewID from URL
   
   $sql="SELECT * FROM category WHERE categoryID='$categoryID'";
   
   $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
     
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
	
	<h1>Update Category</h1>
  
  <form action="categoryupdateprocessing.php" method="post">
  
    <label>Category*:</label> 
   <input type="text" name="category" required value="<?php echo $row['categoryName'] ?>"/><br /></br>
   
   <label>Description*:</label> <br /></br>
   <textarea rows="10" cols="60%" name="description" required ><?php echo $row['categoryDescription'] ?></textarea><br />
   
    <p><input type="hidden" name="categoryID" value="<?php echo $categoryID; ?>" /></p>
	
	<p><input type="submit" name="categoryupdate" value="Update Category" /></p>
	
  </form>
  
  </section> <!-- end content --> 
 
<?php 
   include '../includes/dashboardfooter.php'; 
?>