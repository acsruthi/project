<?php
   include '../includes/connect.php';
   session_start();
   
   //display HTML title tag for each category
   $sql="SELECT * FROM review WHERE reviewID=" . $_GET['reviewID'];
   //select the post using the reviewID
   
   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
   
   while($row=mysqli_fetch_array($result))
   {
     $page=$row['reviewTitle'];
   }
   
   include '../includes/header.php'; 
   include '../includes/nav.php';
?>

<section id="content">
   <div id="middle"> 
	<?php
	   $sql="SELECT review.*,category.*, admin.adminID,admin.adminFname FROM review,admin,category WHERE review.adminID=admin.adminID && review.categoryID=category.categoryID && review.reviewID=". $_GET['reviewID']; //use $_GET to retrieve the reviewID for the full entry
	   
	    $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
		
		 while($row=mysqli_fetch_array($result))
				{
				  if((is_null($row['reviewImage'])) || (empty($row['reviewImage']))) //if the photo field is null or empty
				  {
					 echo "<img src='../images/mvBlack.jpg' width=300 height=210 alt='defaultImage' /></p>"; //display the default image
				  }
				  else
				  {
					 echo "<img src='../images/" .($row['reviewImage'])."'".'width=500 height=280 alt="review"'."/>"; //else display the review image
				  }
				  
				  echo "<h1>" .$row['reviewTitle'] . "</h1>";
				  
				  echo "<p><em>Posted on " .date("F jS Y, g:ia", strtotime($row['reviewDT'])). " by " .$row['adminFname']." in " . $row['categoryName'] . "</em></p>"; //display the date, author and category 
				  
				  /*star rating*/
					$rating=$row['reviewRating']; //retrieve rating from database
					
					for($i=0;$i<$rating;$i++)
					{
					   echo "<img src='../images/star.png' width=35 height=35  alt='filled star' />"; //echo filled stars
					}
			
					for($i=0;$i<5-$rating;$i++)
					{
					   echo "<img src='../images/starUnfilled.png' width=35 height=35  alt='unfilled star' />"; //echo unfilled stars
					}
					
					echo "<p>" .$row['reviewContent'] . "</p>";
				}
		  
   
	?>
	
	
	<h2 id="comment">Comments</h2>
	
	<?php
	   //user messages
	   if(isset($_SESSION['error'])) //if session error is set
	   {
	     echo '<div class="error">';
		 echo '<p>' . $_SESSION['error'] . '</p>' ; //display error message
		 echo "</div>";
		 unset($_SESSION['error']); //unset session error
	   }
	   
	   elseif(isset($_SESSION['success'])) //if session success is set
	   {
	      echo '<div class="success">';
		  echo '<p>' . $_SESSION['success'] . '</p>' ; //display success message
		  echo "</div>";
		  unset($_SESSION['success']); //unset session success
	   }
	?>
	
	<?php
	   $sql="SELECT comment.*,member.memberID, member.memberUname FROM comment, member WHERE comment.memberID = member.memberID && comment.reviewID='" . $_GET['reviewID'] . " 'ORDER By commentDT DESC "; //retrieve the comment for the reviewID
	   
	   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	   
	   $numrows=mysqli_num_rows($result);
	   
	   if($numrows==0)
	   {
	      echo "<p>No comments on this post. </p>";
	   }
	   
	   else
	   {
	      while($row=mysqli_fetch_array($result))
		  {
		    echo "<p><em>Posted on " .date("F jS Y, g:ia", strtotime($row['commentDT'])). " by " .$row['memberUname']. "</em></p>"; //display the date, author and category 
			
			echo $row['comment']; 
		  }
	   }
	   
	?>
	
	<h2>Join the Discussion </h2>
	
	<!--check if user is logged in and , if so , display comment form -->
	<?php
	   if(isset($_SESSION['member']))
	   {
	?>
	   <form action="blogprocessing.php" method="post">
	      <textarea rows="10" cols="60%" name="comment" > </textarea>
		  
		  <!-- use a hidden field to send the reviewID to the next page -->
		  <input type="hidden" value="<?php echo $_GET['reviewID']; ?>" name="reviewID" /> </br>
		  
		  <input type="submit" name="postComment" value=" Post Comment" />
	   </form>
	
	 <?php
	    }
		
		else
		{
		   echo "<p>You must  <a href='login.php?reviewID=" . $_GET['reviewID']. "'> login </a> to comment."; //use the GET array to send the reviewID to the next page if the user clicks the login option in the review
		}
	 ?>
	</div><!--end middle--> 
	 <?php
	     include '../includes/sidebar.php';
	  ?>
	
</section>

 <?php
     include '../includes/footer.php';
  ?>