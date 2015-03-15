<nav class="main"><!--display the dashboard navigation-->
   <ul>
	   <li><a href="../pages/logout.php">Logout  </a></li>
	   <li><a href="../pages/reviewHome.php">|&nbsp; &nbsp;View Site</a> </li>
  </ul>
</nav>

<nav class="secondary">
    <ul>
	    <li><a <?php if($page=='Home'){echo "class='current'";} ?> href="index.php"> Dashboard</a></li>
		  <li><a <?php if($page=='Reviews'){echo "class='current'";} ?> href="reviews.php"> Reviews </a></li>
		  <li><a <?php if($page=='Categories'){echo "class='current'";} ?> href="categories.php"> Categories </a></li>
		  <li><a <?php if($page=='Administrators'){echo "class='current'";} ?> href="administrators.php"> Administrators </a></li>
		  <li><a <?php if($page=='My Account'){echo "class='current'";} ?> href="account.php"> My Account</a></li>
		  <li><a <?php if($page=='Themes'){echo "class='current'";} ?> href="themes.php"> Themes </a></li>
     </ul>
</nav>
		 