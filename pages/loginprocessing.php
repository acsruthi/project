<?php
   session_start();
   include "../includes/connect.php";
?>

<?php
  $reviewID=$_POST['reviewID'];
  $username=mysqli_real_escape_string($con, $_POST['username']);  //prevent SQL injection
  
  $password=mysqli_real_escape_string($con, $_POST['password']);  //prevent SQL injection
  
  $sql="(SELECT member.memberUname, member.memberPword, salt FROM member WHERE memberUname='$username') UNION (SELECT admin.adminUname, admin.adminPword, admin.salt FROM admin WHERE adminUname='$username')";
  
  $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
  
  $row=mysqli_fetch_array($result);  //create a var called $row to store the results
  
  $salt=$row['salt']; //retrieve the random salt from the database
  
  $password=hash('sha256',$password.$salt); //generate the hashed password with the salt value
  
  $sql="(SELECT memberID AS user,  memberUname , memberPword, acntTypeID FROM member WHERE member.memberUname='$username' AND member.memberPword='$password') UNION (SELECT adminID AS user, adminUname,adminPword, acntTypeID FROM admin WHERE admin.adminUname='$username' AND admin.adminPword='$password')"; //sql  query to access to unrelated tables
  
  $result=mysqli_query($con, $sql) or die (mysqli_error($con)); //run the query
  
  $row=mysqli_fetch_array($result);  //create a var called $row to store the results
  
  $count=mysqli_num_rows($result); //count the no of rows returned by the query
  
  if(($count==1) && ($row['acntTypeID']==2) && ($reviewID > 0))  // if the no of matching records equals 1, the user type equals 2 (member user), and $reviewid > 0
  {
     $_SESSION['member']=$row['memberUname']; //initialises a session called 'member' to have a value of username
	 
	 $_SESSION['user']=$row['user']; //initialises a session called 'user' to have a value of memberID
	
	header('location:blogpost.php?reviewID='.$reviewID.'#comment'); //redirect to a specific review page to leave a comment on successful login
  }
  
  elseif(($count==1) && ($row['acntTypeID']==1)) //if the no of matching records == 1 and the user type =1 (admin user)
  {
      $_SESSION['admin']=$row['memberUname']; //initialises a session called 'admin' to have a value of username
	 //(when using UNION, it will only show the first part and doesn't recognise adminUname, so use memberUname.)
	 
	 $_SESSION['user']=$row['user']; //initialises a session called 'user' to have a value of adminID
	 
	 header('location:../admin/index.php'); //redirect to the entry page of the dashboard on successful login
  }
  
  elseif(($count==1) && ($row['acntTypeID']==2))  //if the no of matching records ==1 and the user type =1 (member user)
  {
     $_SESSION['member']=$row['memberUname']; //initialises a session called 'member' to have a value of username
	 
	 $_SESSION['user']=$row['user']; //initialises a session called 'user' to have a value of memberID
	 
     header('location:reviewHome.php'); //redirect to the home page on successful login
  }
  
  else{
      $_SESSION['error']="Incorrect username or password."; //if an error occured , create a session called 'error'
	  
	  header('location:login.php'); //redirects to the login page
  }
  
  
?>