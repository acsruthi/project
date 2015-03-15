<?php
   $page="Themes";
  
   include '../includes/connect.php';
   include '../includes/headerDB.php';
   include '../includes/dashboardnav.php';
   include '../includes/logincheckadmin.php';
?>

<section id="content">
<?php
   //user messages
       
       if(isset($_SESSION['error'])) 
       {
          echo '<div class="error">';
          echo '<p>'.$_SESSION['error'].'</p>';
          echo '</div>';
          unset($_SESSION['error']); //unset session error
       }
       
       elseif(isset($_SESSION['success']))
       {
          echo '<div class="success">';
          echo '<p>'.$_SESSION['success'].'</p>';
          echo '</div>';
          unset($_SESSION['success']); //unset session error
       }
    
?>

<h1>Themes</h1>

<p>Select a theme for your website.</p>

<table class="themeTable" cellspacing="0px" cellpadding="0px">

<?php
   
       $sql = "SELECT * FROM theme"; //select the data from the theme table 
       
       $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
       
       while ($row = mysqli_fetch_array($result)) 
       { 
           echo "<tr><td><img src='../images/" . ($row['themeImage']) . "'" . ' width=400 height=300 alt="movie"' . "/></td>"; //display the theme photo 
           
           echo "<td><h2>" . $row['themeName'] . "</h2>"; //display the theme name 
           
           echo "<p>" . $row['themeDescription'] . "</p>"; //display the theme description 
           
           echo "<form action='themeprocessing.php' method='post'>"; 
           
           echo "<input type='hidden' name='themeID' value=" . $row['themeID'] . ">"; //a hidden form field holds the themeID 
           
           echo "<p><input type='submit' value='Activate'></td></tr>"; 
           
           echo "</form>"; 
       }
?>
</table>
</section> <!-- end content --> 

<?php

    include '../includes/dashboardfooter.php'; 
?>