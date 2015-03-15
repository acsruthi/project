<?php
   $page="Reviews";
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
?>

<section id="content">

    <h1>Reviews</h1>
    
    <p><a href="reviewnew.php"><input type="button" value="Add New"> </a></p>
    
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
    
    <?php
       //retrieve total number of reviews
       
       $sql="SELECT * FROM review";
       
       $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
       
       $numrow=mysqli_num_rows($result);  //retrieve the no.of rows
       
       echo "<p>There are currently <strong>" .$numrow. "</strong> Reviews. </p>"; //echo the total no.of contacts
       
       
       include "../includes/paginationcreate.php";  // include code to build pagination
       
       // retrieve data from database for display
       
      $sql = "SELECT admin.adminID, admin.adminFname, review.*, category.*, COUNT(comment.reviewID) AS commentCount FROM review 
      INNER JOIN admin ON review.adminID = admin.adminID INNER JOIN category ON review.categoryID = category.categoryID 
      LEFT JOIN comment ON review.reviewID = comment.reviewID 
      GROUP BY review.reviewID, comment.reviewID ORDER BY commentDT DESC LIMIT $offset, $rowsperpage"; 
       
      $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
      
      echo "<table class='alt'>"; // display records in a table format
      
      echo "<tr><th>Title</th><th>Author</th><th>Category</th><th>Rating</th><th>Datetime</th><th>Comments</th><th></th></tr>";
    
      while ($row = mysqli_fetch_array($result)) 
        { 
           echo "<tr>"; 
           echo "<td>" . $row['reviewTitle'] . "</td>"; 
           echo "<td>" . $row['adminFname'] . "</td>"; 
           echo "<td>" . $row['categoryName'] . "</td>"; 
           echo "<td class='center'>" . $row['reviewRating'] . "</td>";
           echo "<td>" . date("d/m/y H:i",strtotime($row['reviewDT'])) . "</td>"; 
           echo "<td class='center'>" . $row['commentCount'] . "</td>"; 
           echo "<td><a href=\"reviewupdate.php?reviewID={$row['reviewID']}\">Update</a> | <a href=\"reviewdelete.php?reviewID={$row['reviewID']}\" onclick=\"return confirm('Are you sure you want to delete this review?')\">Delete</a></td>";
           
           echo "</tr>"; 
        } 
        echo "</table>"; 
        
        include "../includes/paginationdisplay.php"; //include code to display pagination
    ?>
    
    </section> <!-- end content --> 
    
    <?php 
       include '../includes/dashboardfooter.php'; 
    ?>