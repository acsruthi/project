<?php
   include '../includes/connect.php';
?>


<div id="sidebar">

<h2>Categories</h2>

    <?php
	  //display the categories
	  $sql="SELECT category.*,COUNT(review.categoryID) AS catnum FROM category INNER JOIN review ON category.categoryID =review.categoryID GROUP BY review.categoryID ORDER BY categoryName ASC"; //count the no.of posts in each category
	  
	  $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	  
	  while($row=mysqli_fetch_array($result))
	  {
	    echo "<p><a href='blogcategories.php?categoryID=" .$row['categoryID'] ."'>" . $row['categoryName'] . "(".$row['catnum'].")</a></p>";
	  }
	?>
	
	<h2>Archives</h2>
	    <?php
		  //display the archive
		  $sql="SELECT month(reviewDT), monthname(reviewDT), year(reviewDT),COUNT(*) AS monthnum FROM review GROUP BY monthname(reviewDT) ORDER BY month(reviewDT)"; //select month and year from datetime field plus groups by month
		  
		  $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
		  
		  while($row=mysqli_fetch_array($result))
		  {
		    echo "<p><a href='blogarchives.php?month=" . $row['month(reviewDT)'] . " '>". $row['monthname(reviewDT)'].  " " .$row['year(reviewDT)']. "(".$row['monthnum'].")</a></p>";
		  }
		?>
  </div>