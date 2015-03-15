<?php
   if((isset($_SESSION['member'])) || (isset($_SESSION['admin']))) //check to see if a member or admin is logged in and , if so , display the logged in menu items
   {
   
?>

<nav class="registration">
  <ul>
    <li><a href="logout.php">Logout  </a></li>
	<li><a href="account.php">|&nbsp; &nbsp;My Account</a></li>
    
    
  </ul>
  
  </nav>  <!--end registration-->

<?php
   }
   else  //if a member or admin is not logged in ,display the not logged in menu items
   {
 ?>
 
 <nav class="registration">
    <ul>
	   <li><a href="login.php">Login  </a></li>
	   <li><a href="registration.php">|&nbsp; &nbsp;Registration</a> </li>
  </ul>
</nav><!--end registration-->

<?php
    }
?>

 <img src="../images/NewHeader.jpg" width="1000px" height="95px" alt="header" class="img-responsive"/> 
 
  <!--  <img src="../images/mvhouse.png" width="150px" height="106px" alt="header" />-->
<nav class="main"><!--display the main navigation-->
   <ul>
     
		  <li><a <?php if($page=='Home'){echo "class='current'";} ?> href="reviewHome.php"> Home</a></li>
		  <li><a <?php if($page=='About'){echo "class='current'";} ?> href="#"> About </a></li>
		  <li><a <?php if($page=='Members'){echo "class='current'";} ?> href="../pages/members.php"> Members </a></li>
		  <li><a <?php if($page=='Contact'){echo "class='current'";} ?> href="#"> Contact </a></li>
   </ul>
   
   <div id="search">
		<form action="search.php" method="get" id="search"> <input type="text" name="search" size="20"
		placeholder="Enter a search term"/>
		</form>
   </div>
   
   
</nav> <!--end main-->


