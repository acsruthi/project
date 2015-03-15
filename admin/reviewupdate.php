<?php
	 $page = "Reviews";
	 include '../includes/connect.php';
	 include '../includes/headerDB.php'; //includes a session_start()
	 include '../includes/dashboardnav.php';
	 include "../includes/logincheckadmin.php";
?>

<?php
   $reviewID = $_GET['reviewID']; //retrieve reviewID from URL
 
	 $sql = "SELECT review.*, category.*, admin.adminFname, admin.adminLname FROM review 
	JOIN admin USING (adminID) JOIN category USING (categoryID) WHERE reviewID = 
	'$reviewID'";
	
	 $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
	 
	 $row = mysqli_fetch_array($result);
?>


<section id="content">

  <h1>Update Review</h1>
  
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
	
	<form action="reviewupdateprocessing.php" method="post"> 
	
	   <label>Title*:</label> <input type="text" name="title" required value="<?php
        echo $row['reviewTitle'] ?>" /><br /> </br>
		
		<label>Content*:</label><br /> <br /> 
		
		<textarea rows="10" cols="60%" name="content" required > <?php echo
       $row['reviewContent'] ?></textarea><br /></br>
 
		<label>Author*:</label>
		
    <!-- create a drop-down list populated by the admin details stored in the 
database --> 
       
	   <select name='adminID'>
		 <option value="<?php echo $row['adminID'] ?>"><?php echo $row['adminFname']
		. " " . $row['adminLname'] ?></option> <!-- display the selected author name -->

       <?php
	   
		 $sql="SELECT * FROM admin";
		 
		 $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
		 
		 while ($row = mysqli_fetch_array($result))
		 {
		 echo "<option value=" . $row['adminID'] . ">" . $row['adminFname'] . " "
		. $row['admiLname'] . "</option>";
		 }
      ?>
	 
</select><br /></br>

   <?php
		 $sql = "SELECT category.* FROM review JOIN category USING (categoryID) 
		WHERE reviewID = '$reviewID'"; //retrieve the selected value
		 $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
		 $row = mysqli_fetch_array($result);
   ?>
   
   <label>Category*:</label>

   <!-- create a drop-down list populated by the categories stored in the 
database -->
   
   <select name='categoryID'>

   <option value="<?php echo $row['categoryID'] ?>"><?php echo
$row['categoryName'] ?></option> <!-- display the selected category name -->
   
   
   <?php
		 $sql="SELECT * FROM category"; 
		 $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
		 while ($row = mysqli_fetch_array($result))
		 {
		 echo "<option value=" . $row['categoryID'] . ">" . $row['categoryName'] .
		"</option>";
		 }
  ?>
  
  </select><br /></br>
  
  <?php
		 $sql = "SELECT review.* FROM review WHERE reviewID = '$reviewID'";
		//retrieve the selected value
		 $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
		 $row = mysqli_fetch_array($result);
 ?>

 <label>Rating*:</label>
  
  <!-- create a drop-down list populated by the rating stored in the database 
-->
 
 <select name='rating'>
	 <option value="<?php echo $row['reviewRating'] ?>"><?php echo $row['reviewRating']
	?></option> <!-- display the selected rating -->
	 
	 <!-- use a for loop to create the rating options up to a maximum of 5 --> 
	 <?php for ($i = 1; $i <= 5; $i++) : ?>
	 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	 <?php endfor; ?>
	 
 </select><br /></br>
 
 <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>">
 <p><input type="submit" name="reviewupdate" value="Update Review" /></p>
 </form>
 
 </br>
 
 <h2>Update Image:</h2>

 <?php
	 if((is_null($row['reviewImage'])) || (empty($row['reviewImage']))) //if the photo field is NULL or empty
	 {
	 echo "<p><img src='../images/mvBlack.jpg' width=300 height=210 alt='default photo' /></p>"; //display the default photo
	 }
	 else
	 {
	 echo "<p><img src='../images/" . ($row['reviewImage']) . "'" . ' width=500 height=280 alt="review photo"' . "/></p>"; //display the review photo
     }
?>

<form action="reviewupdateimageprocessing.php" method="post"
enctype="multipart/form-data">
	 <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>">
	 <label>New Image:</label> <input type="file" name="image" /><br /> 
	 <p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p> </br>
	 <p><input type="submit" name="imageupdate" value="Update Image" /></p>
 </form>

 </section> <!-- end content -->
 
<?php
 include '../includes/dashboardfooter.php';
?>


