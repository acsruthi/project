<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title><?php echo $page ?></title>
   
   <!-- link to favicon-->
   <link href="../images/fav.ico" rel="shortcut icon" />
   
   <!--link to Bootstrap core CSS-->
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
   
   
   <!--link to external CSS -->
   <?php
       $sql = "SELECT themeCSS, current.themeID FROM theme INNER JOIN current USING(themeID)"; //select the css from the theme table and the themeID from the current table
       $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
       $row = mysqli_fetch_array($result); //store the results in a variable named  $row 
   ?>
   <link rel="stylesheet" href="../css/<?php echo $row['themeCSS'] ?>">
   
   
   <!--TinyMCE editor-->
   <script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>
   <script type="text/javascript">
       tinymce.init({
	       selector:"textarea",
		   menubar:false,
		   plugins:"link"
		   });
	</script>
   
   <!-- enable HTML5 in IE 8 and below -->
   <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
</head>

<body>
     <div id="wrap">   
       
           
        
      