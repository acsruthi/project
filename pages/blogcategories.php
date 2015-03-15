<?php
   include '../includes/connect.php';
   session_start();
   //display HTML title tag for each category
   
   $sql="SELECT * FROM category WHERE category.categoryID=" . $_GET['categoryID'];
   //retrieve the category
   
   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
   
   while($row=mysqli_fetch_array($result))
   {
     $page=$row['categoryName'];
   }
   
   include '../includes/header.php'; 
   include '../includes/nav.php';
?>

<section id="content">
 <div id="middle">  
   <table class="reviewTable" border="0" cellspacing="0" cellpadding="0">
    <?php
	   $sql="SELECT * FROM category WHERE category.categoryID=".$_GET['categoryID']; //retrieve the category
	   
	   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	   
	   $row=mysqli_fetch_array($result);
	   echo "<h1>" . $row['categoryName'] . "</h1>"; //display the category
	   
	   $sql="SELECT review.*,category.*,admin.adminID,admin.adminFname,COUNT(comment.reviewID) AS commentcount FROM review INNER JOIN admin ON review.adminID= admin.adminID INNER JOIN category ON review.categoryID=category.categoryID LEFT JOIN comment ON review.reviewID =comment.reviewID WHERE category.categoryID='".$_GET['categoryID']."'GROUP BY review.reviewID, comment.reviewID ORDER BY review.reviewDT DESC"; //retrieve record that match the category and count the no.of comment
	   
	   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	   
	   while($row=mysqli_fetch_array($result))
	   {
	      if((is_null($row['reviewImage'])) || (empty($row['reviewImage']))) //if the photo field is null or empty
		  {
		     echo "<tr><td><img src='../images/mvBlack.jpg' width=300 height=210 alt='defaultImage' /></td>"; //display the default image
		  }
		  else
		  {
		     echo "<tr><td><img src='../images/" .($row['reviewImage'])."'".'width=300 height=200 alt="review"'."/></td>"; //else display the review image
		  }
		  
		  echo "<td><h1><a href='blogpost.php?reviewID=" .$row['reviewID'] ."'>".$row['reviewTitle'] . "</a></h1>";
		  
		  echo "<p><em>Posted on " .date("F jS Y, g:ia", strtotime($row['reviewDT'])). " by " .$row['adminFname']." in " . $row['categoryName'] . "</em></p>"; //display the date, author and category 
		  
		  /*star rating*/
			$rating=$row['reviewRating']; //retrieve rating from database
			
			for($i=0;$i<$rating;$i++)
			{
			   echo "<img src='../images/star.png'  width=35 height=35 alt='filled star' />"; //echo filled stars
			}
			
			for($i=0;$i<5-$rating;$i++)
			{
			   echo "<img src='../images/starUnfilled.png'  width=35 height=35 alt='unfilled star' />"; //echo unfilled stars
			}
			
			echo "<p>" . (substr(($row['reviewContent']),0,300)) . "..." ."<a href='blogpost.php?reviewID=" .$row['reviewID']. "'>" ."<span class='alternative'>read more</span>" . "</a><br />"; //limit the display to 300 charas and add a 'read more' link
			
			echo "<p><a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>". "<span class='alternative'>Comments(" . $row['commentcount'] . ")</span></a></td></tr>"; //add the no.of comments on the post
		  
	   }
	   
	  
	   
	?>
     </table>
	</div>
	 <?php
	     include '../includes/sidebar.php';
	  ?>
	  
</section> <!--end content-->	
  
  <?php
     include '../includes/footer.php';
  ?>