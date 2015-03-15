<?php
    $page="Members";
	session_start();
	include '../includes/connect.php';
	include '../includes/header.php'; 
	include '../includes/nav.php';  
?>

<section id="content">
  <div id="middle">
    <h1>Search Results</h1>
	
	<?php
	   $term=mysqli_real_escape_string($con, $_GET['search']); //prevents sql injection
	   
	   $sql="SELECT review.*,admin.adminID,admin.adminFname,category.* FROM review INNER JOIN admin USING(adminID) INNER JOIN category USING(categoryID) WHERE reviewTitle LIKE '%$term%' OR 
       reviewContent LIKE '%$term%' OR categoryName LIKE '%$term%' OR adminFname LIKE '%$term%' ORDER BY reviewDT DESC"; //use LIKE to find values that matches the term entered and order by date from the most recent review
	   
	   $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	   
	   $numrow=mysqli_num_rows($result);// retrive the no.of rows
	   
	    //display if no search term entered
		 if(empty($_GET['search']))  
		 {
			echo "<p>You did not enter a search term</p>";
		 }
		 
		 //display if no matches to search  
		 else if ($numrow==0) 
		 {
		   echo "<p>Sorry, no matches found." . $term . "</P>";
		 }
		 
		 //display the search results
		 else
		 {
			echo "<p>Your search for <strong>" .$term . "</strong> has retrieved ".$numrow . " results:</p>";  
			
			 while($row=mysqli_fetch_array($result))	//loop through results for each match
	         {
			     echo preg_replace("/($term)/i", "<span class='keyword'> $0</span>", "<h2 class='spaceTop spaceBottom'><a href='blogpost.php?reviewID=" .$row['reviewID'] . "'>" .$row['reviewTitle'] . "</a></h2>"); //display the post title
				 
				 echo "<p class='details'><em> Posted on " .date("F jS Y, g:ia", strtotime($row['reviewDT'])) ." by " .preg_replace("/($term)/i","<span class='keyword'>$0</span>", $row['adminFname']) . " in " . preg_replace("/($term)/i","<span class='keyword'> $0</span>", $row['categoryName'])."</em></p>"; //display the date, author and category
				 
				 echo preg_replace("/($term)/i","<span class='keyword'>$0</span>", "<p>" .(substr(($row['reviewContent']),0,100)) ."..." ."</p></br>"); //limit displayed characters to 100
	          }
		  }
	?>

    </div>
	 <?php
	     include '../includes/sidebar.php';
	  ?>
</section>

<?php
    include "../includes/footer.php";
?>