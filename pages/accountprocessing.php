<?php
   session_start();
   include "../includes/connect.php";
?>

<?php
    
    $memberID=$_POST['memberID'];
	    
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
       
       //$sql="SELECT * FROM member WHERE memberUname='$username'"; //check if the username is taken
       
      //$result=mysqli_query($con,$sql) or die (mysqli_error($con)); //run the query
       
       if($firstName==""||$lastName==""||$postcode==""||$country==""||$email==""||
      $gender=="")//check if any required field is empty
      {
         $_SESSION['error']='All *fields are required.';
         
         header("location:account.php"); //redirects to registration.php
        
         exit();
         
      }
      
      elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))  //check if email is valid
      {
         $_SESSION['error']='Please enter a valid email address.';
         
         header("location:account.php"); //redirects to registration.php
        
         exit();
      }
      
      else
      {
          $sql="UPDATE member SET memberFname='$firstName', memberLname='$lastName', memberStreet='$street',
          memberSuburb='$suburb', memberPost='$postcode',memberCountry='$country',memberPhone='$phone', memberMob='$mobile',
          memberEmail='$email',memberGender='$gender',memberNewsletter='$newsletter' WHERE memberID='$memberID'";
         
          $result=mysqli_query($con,$sql) or die (mysqli_error($con)); //run the query
          
          $_SESSION['success']='Account updated successfully'; //a success msg is displayed, if the acnt update successfully
        
          header("location:account.php"); //redirects to login page
          
          
       
      }
?>