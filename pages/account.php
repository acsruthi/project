<?php
    $page="My Account";
	session_start();
	include '../includes/connect.php';
	include '../includes/header.php'; 
    include '../includes/nav.php';  
	include '../includes/logincheckmember.php';
    	
 ?>
 
 <?php
     $memberID=$_SESSION['user'];
	 $sql="SELECT * FROM member WHERE memberID='$memberID'";
	 $result=mysqli_query($con,$sql) or die(mysqli_error($con)); //run the query
	 $row=mysqli_fetch_array($result);
 ?>
 
 <section id="content">
 
 <?php
 //user messages
    if(isset($_SESSION['error'])) //if session error is set
	   {
	     echo '<div class="error">';
		 echo '<p>' . $_SESSION['error'] . '</p>' ; //display error message
		 echo "</div>";
		 unset($_SESSION['error']); //unset session error
	   }
	   
	   elseif(isset($_SESSION['success'])) //if session success is set
	   {
	      echo '<div class="success">';
		  echo '<p>' . $_SESSION['success'] . '</p>' ; //display success message
		  echo "</div>";
		  unset($_SESSION['success']); //unset session success
	   }
 ?>
 
 <div id="left">
   <h1>My Account</h1>
 
    <p>Update your account details.</p>
 
      <form action="accountprocessing.php" method="post">
	
	       <label>Username*:</label> <input type="text" name="username" required value="<?php echo $row['memberUname'] ?>" readonly /> <br/><br/>
		   
		   		   
		   <label>First Name*:</label> <input type="text" name="firstName" required value="<?php echo $row['memberFname'] ?>"/> <br/><br/>
		   
		   <label>Last Name*:</label> <input type="text" name="lastName" required value="<?php echo $row['memberLname'] ?>"/> <br/><br/>
		   
		   <label>Street:</label> <input type="text" name="street" value="<?php echo $row['memberStreet'] ?>"/> <br/><br/>
		   
		   <label>Suburb:</label> <input type="text" name="suburb" value="<?php echo $row['memberSuburb'] ?>"/> <br/><br/>
		   
		   		   
		   <label>Postcode*:</label> <input type="text" name="postcode" required value="<?php echo $row['memberPost'] ?>"/> <br/><br/>
		   
		   <label>Country*:</label> <input type="text" name="country" required value="<?php echo $row['memberCountry'] ?>"/> <br/><br/>
		   
		   <label>Phone:</label> <input type="text" name="phone" value="<?php echo $row['memberPhone'] ?>"/> <br/><br/>
		   
		   <label>Mobile:</label> <input type="text" name="mobile" value="<?php echo $row['memberMob'] ?>"/> <br/><br/>
	
	       <label>Email*:</label> <input type="text" name="email" required value="<?php echo $row['memberEmail'] ?>"/> <br/><br/>
		   
		   <label>Gender*:</label> 
		   
		   
		 <?php
		      //generate drop-down list for gender using enum data type and values from db
			  
			  $tableName='member';
			  $colGender='memberGender';
			  
			   function getEnumGender($tableName, $colGender)
			 {
			    global $con; //enable db connection in the function
				
				$sql="SHOW COLUMNS FROM $tableName WHERE field='$colGender'"; //retrieve enum column
				
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				//run the query
				
				$row=mysqli_fetch_array($result);  //create a var called $row to store the results
				
				$type=preg_replace('/(^enum\()/i','',$row['Type']);  //regular expression to replace the eum syntax with blank space
				
				$enumValues=substr($type,0,-1); //return the enum string
				
				$enumExplode=explode(',',$enumValues); //split the enum string into individual values
				
				return $enumExplode; //return all the enum individual values
			 }	
				$enumValues=getEnumGender('member','memberGender');
			    echo '<select name="memberGender">';
			 
			    echo "<option value=". $row['memberGender'].">" .$row['memberGender']."</option>";  //display the selected enum values
				
			 foreach($enumValues as $value)
			 {
			    echo '<option value="'.$removeQuotes =str_replace("'","",$value).'">'.$removeQuotes=str_replace("'","",$value).'</option>'; //remove the quotes from the enum values
			 }
			 
			 echo '</select> ';
			 
		?>			
			<br />
           
		   <p>Subscribe to weekly email newsletter?</p>
		   
		   <label>Yes</label> <input type="radio" name="newsletter" value="Y" <?php if($row['memberNewsletter']=="yes") {echo "checked";}?> /> <br/>
		   
		   <label>No</label> <input type="radio" name="newsletter" value="N" <?php if($row['memberNewsletter']=="no") {echo "checked";}?> /> <br/><br/>
		   
		   
		   <input type="hidden" name="memberID" value="<?php echo $memberID; ?>" />
		 
		   
		   <p><input type="submit" name="accountupdate" value="Update Account" /></p>
		   
	 </form>	
 </div>
 
 <div id="right">
    <h1>Update Image</h1>

     <?php
	    if((is_null($row['memberImage'])) || (empty($row['memberImage']))) //if the photo field is NULL or empty
		{
		   echo "<p><img src='../images/default.png' width=150 height=150 alt='default photo' /></p>"; //display the default photo
		}
		
		else
		{
		   echo "<p><img src='../images/" .($row['memberImage'])."'".' width=150 height=150 alt="contact photo"' ." /></p>"; //display the contact photo
		}
     ?>	 
		  
		  
	  <form action="accountimageprocessing.php" method="post" enctype="multipart/form-data">
        
			<input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
			
			<label>New Image:</label> <input type="file" name="image" /><br/>
			
			<p>Accepted files are JPG,GIF or PNG. Maximum size is 500kb.</p>
			
			<p><input type="submit" name="imageupdate" value="Update Image" /> </p>
		</form></br>
		
		<h1>Update Password</h1>
		<P>Passwords must  have a minimum of 8 characters .</p>
		
		<form action="accountpasswordprocessing.php" method="post"> 
		    
            <label>New Password:*</label> <input type="password" name="password" pattern=".{8,}" title="Password must be 8 characters or more" required /><br/>
			<input type="hidden" name="memberID" value="<?php echo $memberID; ?>"> </br>
			
			 <p id="pw"><input type="submit" name="passwordupdate" value="Update Password" /></p>
		   
		</form>	</br>
		
		<h1>Delete My Account</h1>
		
		<p>We are sorry to hear you'd like to delete your account. By clicking the button below you will permanently delete your account.</p>
		
		<form action="accountdelete.php" method="post"> 
		    
			<p><input type="submit" value="Delete My Account" onclick="return confirm('Are you sure you wish to permanently delete your account?');" /></p>
			   
			 <input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
	    </form>
		
 </div>		
  </section>
  
 <?php
    include "../includes/footer.php";
?>
 
 
 