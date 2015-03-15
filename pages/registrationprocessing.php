<?php
   session_start();
   include "../includes/connect.php";
?>

<?php
   $username=mysqli_real_escape_string($con,$_POST['username']); //prevent SQL injection
   $password=mysqli_real_escape_string($con,$_POST['password']);
   
   $firstName=mysqli_real_escape_string($con,$_POST['firstName']);
   
   $lastName=mysqli_real_escape_string($con,$_POST['lastName']);
   
   $street=mysqli_real_escape_string($con,$_POST['street']);
   
   $suburb=mysqli_real_escape_string($con,$_POST['suburb']);
   
   //$state=mysqli_real_escape_string($con,$_POST['state']);
   
   $postcode=mysqli_real_escape_string($con,$_POST['postcode']);
   
   $country=mysqli_real_escape_string($con,$_POST['country']);
   
   $phone=mysqli_real_escape_string($con,$_POST['phone']);
   
   $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
   
   $email=mysqli_real_escape_string($con,$_POST['email']);
   
   $gender=mysqli_real_escape_string($con,$_POST['memberGender']);
   
   $newsletter=mysqli_real_escape_string($con,$_POST['newsletter']);
   
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
      
      elseif(($_FILES['image']['type']=='image/jpg') || ($_FILES['image']['type'] == 'image/jpeg') || ($_FILES['imge']['type']=='image/gif') || ($_FILES['image']['type']=='image/png') && in_array($extension, $allowedExts))
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
      
      if(strlen($password) <8) //check if the password is a minimum of 8 chars long
      {
         $_SESSION['error']='Password must be 8 characters or more.';
         
         header("location:registration.php"); //redirects to registration.php
        
         exit();
      }
      
      $salt=md5(uniqid(rand(),true)); //create a random salt value
      
      $password=hash('sha256',$password.$salt); //generate the hashed pw with the salt value
      
      $sql="(SELECT memberUname FROM member WHERE member.memberUname='$username') UNION (SELECT adminUname FROM admin WHERE admin.adminUname='$username')"; //check if the username is taken in the member table or the admin table as the username must be unique
      
      $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
  
      $numrow=mysqli_num_rows($result);  //count how many rows are returned
      
      if($numrow > 0) //if count >0
      {
         $_SESSION['error']='Username taken. Please retry.'; //if the username is taken initialise a session called 'error' with  a msg
         
         header("location:registration.php"); //redirects to registration.php
        
         exit();
      }
      
      elseif($username==""||$password==""||$firstName==""||$lastName==""||$postcode==""||$country==""||$email==""||
      $gender==""||$newsletter=="")//check if any required field is empty
      {
         $_SESSION['error']='All *fields are required.';
         
         header("location:registration.php"); //redirects to registration.php
        
         exit();
      }
      
      elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))  //check if email is valid
      {
         $_SESSION['error']='Please enter a valid email address.';
         
         header("location:registration.php"); //redirects to registration.php
        
         exit();
      }
      
      else
      {
        $sql="INSERT INTO member (memberUname,memberPword,salt,memberFname,memberLname,memberStreet,memberSuburb,memberPost,memberCountry,memberPhone,memberMob,
        memberEmail,memberGender,memberJoinD,memberNewsletter,memberImage,acntTypeID) VALUES ('$username','$password','$salt','$firstName','$lastName','$street','$suburb','$postcode','$country','$phone','$mobile',
        '$email','$gender',NOW(),'$newsletter','$newImageName','2')";
        
        $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
        
         $_SESSION['success']='You created a new account. Please login.'; //if registration is successful , initialises a session called 'success' with a message
        
        header("location:login.php"); //redirects to login page
      }
      
  
   
?>