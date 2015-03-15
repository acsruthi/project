<?php
   session_start();
   include "../includes/connect.php";
?>

<?php
    $memberID=$_POST['memberID'];
	
	
   if($_FILES['image']['name']) //if an image has been uploaded
   {
      $image=$_FILES['image']['name']; //the PHP file upload var for a file 
	  
	  $randomDigit=rand(0000,9999) ;//generate  a random numerical digit <=4 charas
	  
	  $newImageName=strtolower($randomDigit .  "_" .$image); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security
      
      $target="../images/".$newImageName; //the target for uploaded images
      
      $allowedExts=array('jpg','jpeg','gif','png'); //create an array with the allowed file extensions
      
      $tmp=explode('.',$_FILES['image']['name']); //split the file name from the file extension
      
      $extension=end($tmp);//retrieve the extension of the photo e.g.,png
      
      if($_FILES['image']['size'] >512000) //image max size is 500kb
      {
        $_SESSION['error']='Your file size exceeds max of 500kb.'; //if the file exceeds max size initialise asession called 'error' with a msg
        
        header("location:registration.php"); //redirects to registration.php
        
        exit();
        
      }
      
      elseif(($_FILES['image']['type']=='image/jpg') || ($_FILES['image']['type'] == 'image/jpeg') || ($_FILES['image']['type']=='image/gif') || ($_FILES['image']['type']=='image/png') && in_array($extension, $allowedExts))
      {
         move_uploaded_file($_FILES['image']['tmp_name'],$target);  //move the images to the image folder
      }
      else
      {
         $_SESSION['error']='Only jpg, gif and png files allowed.'; //if the file uses an invalid extension initialises a sessio called 'error' with a msg
         
         header("location:registration.php"); //redirects to registration.php
        
         exit();
      }
    }
	
	$sql="UPDATE member SET memberImage='$newImageName' WHERE memberID='$memberID'";
	
	$result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	
	 $_SESSION['success']='Image updated successfully'; //if registration is successful , initialises a session called 'success' with a message
        
      header("location:account.php"); //redirects to account page
     
?>