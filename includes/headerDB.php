<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title><?php echo $page ?></title>
   
   <!-- link to favicon-->
   <link href="../images/fav.ico" rel="shortcut icon" />
   
     
   
   <!--link to external CSS -->
   
   <link rel="stylesheet" href="../css/styleDB.css" />
   
 
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
       