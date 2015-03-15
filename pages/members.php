<?php
    $page="Members";
	session_start();
	include '../includes/connect.php';
	include '../includes/header.php'; 
	include '../includes/nav.php';  
?>

<section id="content">
      <h1>Meet our members </h1>
	  
	  <?php
	    //retrieve total no.of members
		
		$sql="SELECT * FROM member";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
		
		$numrow=mysqli_num_rows($result);// retrive the no.of rows
		
		echo "<p><em>There are currently <strong>". $numrow. "</strong> Movie House members.</em></p>"; //echo the total no.of contacts
		
		//create pagination
		$rowsperpage=6; //no.of rows to show per page
		
		$totalpages=ceil($numrow / $rowsperpage); //find out total pages
		
		//get the current page or set a default
		if(isset($_GET['currentpage']) && is_numeric($_GET['currentpage']))
		{
		   $currentpage=(int) $_GET['currentpage']; //cast var as int
		}
		
		else
		{  
		   $currentpage=1;// default page number
		   
		}
		
		//if current page is greater than total pages,
		if($currentpage > $totalpages)
		{
		   $currentpage=$totalpages; //set current page to last page
		}
		
		//if current page is less than first page,
		if($currentpage < 1)
		{
		   $currentpage=1; //set current page to first page
		}
		
		//the offset of the list,based on current page
		$offset= ($currentpage - 1) * $rowsperpage;
		
		//retrieve data from database for display
		$sql="SELECT * FROM member ORDER BY memberJoinD DESC LIMIT $offset, $rowsperpage";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
      ?>
      
      
   <section class="row">
    <?php
    
   		while($row=mysqli_fetch_array($result))
		{
		   if((is_null($row['memberImage'])) || (empty($row['memberImage'])))  //if the photo field is NULL or empty
		   {
		      echo "<div class='col-md-2'><img src='../images/default.png' width=150 height=150 alt='default photo' /></div>"; //display the default photo
		   }
		   
		   else
		   {
		      echo "<div class='col-md-2'><img src='../images/" .($row['memberImage'])." ' " . 'width=150 height=150 alt="contact photo" ' ."/></div>"; //display the contact photo
		   }
		   
		   echo "<p><div class='col-md-2'><strong>" . $row['memberUname'] . "</strong></br>";
		   echo "<em>Username</em></p>";
		   echo "<p><strong>" . $row['memberCountry'] . "</strong></br>";
		   echo "<em>Location</em></p>";
		   echo "<p><strong>" .date("F Y", strtotime($row['memberJoinD'])) . "</strong></br>"; //format date
		   echo "<em>Member since </em></p></div>";
		   
		   
		}
	?>
 </section>
 
  <?php 
		//build pagination links
		
		$range=4; //no.of links to show
		
		echo "<div id='pagination'>";
		
		//if not on page 1, don't show back links
		if($currentpage > 1)
		{
		   echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=1'> <<<</a> &nbsp; "; //echo link to go back to first page
		   
		   $prevpage=$currentpage - 1; //get previous page number
		   
		   echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'> Prev</a> &nbsp; "; //echo link to got back to previous page
		}
		
		//loop to show links to range of pages around current page
		for($x=($currentpage - $range); $x <(($currentpage + $range) + 1); $x++)
		{
		   //if it's  a valid page number
		   if(($x > 0) && ($x <= $totalpages))
		   {
		      //if we are on current page
			  if($x == $currentpage)
			  {
			     echo "<span class='activePagination'> $x </span>&nbsp;";//don't make a link
			  }
			  else //if not current page
			  {
			     echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a>&nbsp;"; // make it a link
			  }
		   }
		}
		
		//if not on last page, show forward and last page links
		if($currentpage != $totalpages)
		{
		  $nextpage= $currentpage+1; //get next page
		  
		  echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'> Next</a>&nbsp;";// echo forward link for next page
		  
		  echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'> >>></a>";//echo forward link for last page
		}
		
		echo "</div>"; //end pagination
		
		
	  ?>
   
</section>


<?php
    include "../includes/footer.php";
?>
	