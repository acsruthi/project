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
    
	<h1>Categories</h1>
    
    <p><a href="categorynew.php"><input type="button" value="Add New"> </a></p>
	
	 <?php
       //retrieve total number of reviews
       
       $sql="SELECT * FROM category";
       
       $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
       
       $numrow=mysqli_num_rows($result);  //retrieve the no.of rows
       
       echo "<p>There are currently <strong>" .$numrow. "</strong> Categories. </p>"; //echo the total no.of contacts
	   
	   include "../includes/paginationcreate.php";  // include code to build pagination
       
	   // retrieve data from database for display
	   
	   $sql="SELECT category.*, COUNT(review.categoryID) AS categoryCount FROM
		category LEFT JOIN review ON category.categoryID = review.categoryID GROUP BY
		category.categoryID ORDER BY categoryName ASC LIMIT $offset,$rowsperpage";
		
		$result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
      
        echo "<table class='alt'>"; // display records in a table format
      
	    echo "<tr><th>Category</th><th>Description</th><th>Reviews</th><th></th></tr>";
		
		while ($row = mysqli_fetch_array($result)) 
        { 
           echo "<tr>"; 
           echo "<td>" . $row['categoryName'] . "</td>"; 
           echo "<td>" . $row['categoryDescription'] . "</td>"; 
           echo "<td class='center'>" . $row['categoryCount'] . "</td>"; 
		   echo "<td><a href=\"categoryupdate.php?categoryID={$row['categoryID']}\">Update</a> | <a href=\"categorydelete.php?categoryID={$row['categoryID']}\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a></td>";
		   
		   echo "</tr>";
		}
		
		 echo "</table>"; 
        
        include "../includes/paginationdisplay.php"; //include code to display pagination
    ?>
	
</section> <!-- end content --> 
    
    <?php 
       include '../includes/dashboardfooter.php'; 
    ?>

	   
	   
	   
	   
	   
       
       
