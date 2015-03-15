<?php
   $page="Reviews";
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
?>

<section id="content">
  
   <h1>Add New Review</h1>
   
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
   
 <form action="reviewnewprocessing.php" method="post" enctype="multipart/form-data"> 
   <label>Title*:</label> 
   <input type="text" name="title" required /><br /></br>
   
   <label>Content*:</label> <br /></br>
   <textarea rows="10" cols="60%" name="content" ></textarea><br /></br>
   
   <label>Author*:</label>
   
   <!-- create a drop-down list populated by the admin details stored in the database -->
   
   <select name='adminID'> 
   <option value="">Please select</option>
   
   <?php 
       $sql="SELECT * FROM admin";
   
       $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
       
            while ($row = mysqli_fetch_array($result)) 
            { 
               echo "<option value=" . $row['adminID'] . ">" . $row['adminFname'] . " " . $row['adminLname'] . "</option>";
            }
   ?>
   
   </select><br />   </br>

   <label>Category*:</label>

   <!-- create a drop-down list populated by the categories stored in the database --> 
        <select name='categoryID'> 
        <option value="">Please select</option>

            <?php 
               $sql="SELECT * FROM category";
               $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
			   while ($row = mysqli_fetch_array($result))
               { 
                  echo "<option value=" . $row['categoryID'] . ">" . $row['categoryName'] . "</option>"; 
               } 
            ?>
            
        </select><br /> </br>  
        
        <label>Rating*:</label>
        
       <!-- create a drop-down list populated by the rating stored in the database -->

       <select name='rating'> 
       <option value="">Please select</option> 
       
       <!-- use a for loop to create the rating options up to a maximum of 5 --> 
       <?php 
          for ($i = 1; $i <= 5; $i++) : 
       ?> 
       
       <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option> 
       
       <?php endfor; ?> 
       
       </select><br />  </br>    
       
       <label>Image:</label> 
       
       <input type="file" name="image" /><br /> </br>
       
       <p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p>
       
       <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>"> 
       
       <p><input type="submit" name="reviewnew" value="Add New Review" /></p>
       
</form>


</section> <!-- end content --> 
 
<?php 
   include '../includes/dashboardfooter.php'; 
?>
       