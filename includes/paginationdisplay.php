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