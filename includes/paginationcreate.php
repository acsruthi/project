<?php

        //create pagination
		$rowsperpage=10; //no.of rows to show per page
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
?>		
		