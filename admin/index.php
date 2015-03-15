<?php
   $page="Home";
   include '../includes/connect.php';
   include '../includes/logincheckadmin.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
?>

<section id="content">
   
    <h1>Dashboard</h1>
    
    <p>Welcome to your custom Content Management System.</p>
    
    <?php
      
      $sql="SELECT (SELECT COUNT(*) FROM review) AS 'totalReviews', (SELECT  COUNT(*) FROM category) AS 'totalCategories',
       (SELECT COUNT(*) FROM admin) AS totalAdministrators, (SELECT COUNT(*) FROM theme) AS totalThemes";
       
       $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
		 
       while($row=mysqli_fetch_array($result))
		{
           echo "<table class='alt'>";
           echo "<tr><th colspan='2'> At a glance </th></tr>";
           echo "<tr>";
           echo "<td>" . $row['totalReviews'] . "</td><td> Total Reviews </td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td>" . $row['totalCategories'] . "</td><td> Total Categories </td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td>" . $row['totalAdministrators'] . "</td><td> Total Administrators </td>";
           echo "</tr>";
           echo "<tr>";
           echo "<td>" . $row['totalThemes'] . "</td><td> Total Themes </td>";
           echo "</tr>";
           echo "</table>";
        }   
           
    ?>    
</section>   <!--end content -->

<?php
     include '../includes/dashboardfooter.php';
  ?>