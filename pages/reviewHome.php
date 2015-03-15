<?php
    $page="ReviewHome";
	session_start();
    include "../includes/connect.php";
	include '../includes/header.php';
	include '../includes/nav.php';
?>


   
      
  <!--   <img src="../images/SeventhSon.jpg" alt="slider" width="1000" height="563" />  -->
    <section id="content">  
    
      <div id="middle">
      
      <table class="reviewTable" border="0" cellspacing="0" cellpadding="0">
      
	  <?php
	     $sql="SELECT admin.adminID,admin.adminFname,review.*,category.*,COUNT(comment.reviewID)
		 AS commentcount FROM review INNER JOIN admin ON review.adminID=admin.adminID INNER JOIN category ON review.categoryID = category.categoryID LEFT JOIN comment ON review.reviewID=comment.reviewID GROUP BY review.reviewID, comment.reviewID ORDER BY reviewDT DESC LIMIT 0,3";
		 // display the last 3 reviews and count the no.of comments for each review
		 
		 $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
		 
		 while($row=mysqli_fetch_array($result))
		 {
		    if((is_null($row['reviewImage'])) || (empty($row['reviewImage']))) //if the image field is NULL or empty
			{
			  echo "<tr><td><img src='../images/mvBlack.jpg' width=300 height=210 alt='defaultImage' /></td>"; //display the default image
			}
			
			else
			{
			   echo "<tr><td><img src= '../images/" .($row['reviewImage'])."'".'width=250 height=180 alt="review"'."/></td>"; //else display the review image
			}
			
			echo "<td><h1><a href='blogpost.php?reviewID=" .$row['reviewID'] ."'>".$row['reviewTitle'] . "</a></h1>";
			
			echo "<p><em>Posted on " .date("F jS Y, g:ia", strtotime($row['reviewDT'])). " by " .$row['adminFname']." in " . $row['categoryName'] . "</em></p>"; //display the date,author and category 
			
			/*star rating*/
			$rating=$row['reviewRating']; //retrieve rating from database
			
			for($i=0;$i<$rating;$i++)
			{
			   echo "<img src='../images/star.png' alt='filled star' width=35 height=35 />"; //echo filled stars
			}
			
			for($i=0;$i<5-$rating;$i++)
			{
			   echo "<img src='../images/starUnfilled.png' alt='unfilled star' width=35 height=35 />"; //echo unfilled stars
			}

			echo "<p>" . (substr(($row['reviewContent']),0,300)) . "... <a href='blogpost.php?reviewID=" .$row['reviewID']. "'> <span class='alternative'>read more</span></a><br />"; //limit the display to 300 charas and add a 'read more' link
			
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