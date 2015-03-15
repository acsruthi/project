<?php
   $page="Administrators";
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
	
	<h1>Administrators</h1>
    
    <p><a href="administratornew.php"><input type="button" value="Add New"> </a></p>
	
	<?php
	   //retrieve total number of reviews
       
       $sql="SELECT * FROM admin";
       
       $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
       
       $numrow=mysqli_num_rows($result);  //retrieve the no.of rows
	   
	   echo "<p>There are currently <strong>" .$numrow. "</strong> Administrators. </p>"; //echo the total no.of contacts
	   
	   include "../includes/paginationcreate.php";  // include code to build pagination
       
	   // retrieve data from database for display
	   $sql="SELECT admin.*, COUNT(review.adminID) AS reviewCount FROM admin LEFT JOIN review USING(adminID) GROUP BY admin.adminID ORDER BY adminUname ASC LIMIT $offset,$rowsperpage";
	   
	   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	   
	    echo "<table class='alt'>"; // display records in a table format
      
	    echo "<tr><th>Username</th><th>Name</th><th>Email</th><th>DateTime</th><th>Reviews</th></tr>";
		
		while ($row = mysqli_fetch_array($result)) 
        { 
           echo "<tr>"; 
           echo "<td>" . $row['adminUname'] . "</td>"; 
           echo "<td>" . $row['adminFname'] ."" . $row['adminLname']. "</td>"; 
		   echo "<td><a href='mailto:" . $row['adminEmail'] . "'>" . $row['adminEmail']."</a></td>";
		   echo "<td>" . date("d/m/y H:i",strtotime($row['adminJoinD'])). "</td>";
		   
		   echo "<td class='center'>" .$row['reviewCount'] . "</td>";
		   echo "</tr>";
	    }
		
		echo "</table>";
		
		include "../includes/paginationdisplay.php"; //include code to display pagination
	   
	?>
	
</section> <!-- end content --> 
    
    <?php 
       include '../includes/dashboardfooter.php'; 
    ?>