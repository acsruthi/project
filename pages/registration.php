<?php
    $page="Registration";
	session_start();
	include '../includes/connect.php';
	include '../includes/header.php'; 
    include '../includes/nav.php';    
 ?>
 
 <section id="content">
    <h1>Welcome to Movie House</h1>
	
	<p>Complete the details below to sign up for a new account.</p>
	<p style="color:#DF3A01;">Passwords must have a min of 8 characters.</p>
	
	<?php
	   //user msgs
	   
	   if(isset($_SESSION['error'])) //if session error is set
	   {
	     echo '<div class="error">';
		 echo '<p>'.$_SESSION['error'].'</p>'; //display error msg
		 echo '</div>';
		 unset($_SESSION['error']); //unset the error
	   }
	?>
	
	<form action="registrationprocessing.php" method="post" enctype="multipart/form-data"> <!--the multipart/form-data is essential for file upload functionality-->
	
	       <label>Username*:</label> <input type="text" name="username" required /> <br/><br/>
		   
		   <label>Password*:</label> <input type="password" name="password" required pattern=".{8,}" title="Password must be 8 characters or more" /> <br/><br/>
		   
		   <label>First Name*:</label> <input type="text" name="firstName" required /> <br/><br/>
		   
		   <label>Last Name*:</label> <input type="text" name="lastName" required /> <br/><br/>
		   
		   <label>Street:</label> <input type="text" name="street" /> <br/><br/>
		   
		   <label>Suburb:</label> <input type="text" name="suburb" /> <br/>
	
	    <!--   <label>State:</label> -->
		   
		   <?php
		     //generate drop-down list for state using enum data type and values from the db
			 
			/* $tableName='member';
			 $colState='state';
			 
			 function getEnumState($tableName, $colState)
			 {
			    global $con; //enable db connection in the function
				
				$sql="SHOW COLUMNS FROM $tableName WHERE field='$colState'"; //retrieve enum column
				
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				//run the query
				
				$row=mysqli_fetch_array($result);  //create a var called $row to store the results
				
				$type=preg_replace('/(^enum\()/i','',$row['Type']);  //regular expression to replace the eum syntax with blank space
				
				$enumValues=substr($type,0,-1); //return the enum string
				
				$enumExplode=explode(',',$enumValues); //split the enum string into individual values
				
				return $enumExplode; //retunr all the enum individual values
			 }
			 
			 $enumValues=getEnumState('member','state');
			 echo '<select name="state">';
			 
			 echo "<option value='' > Please select </option>";
			 
			 foreach($enumValues as $value)
			 {
			    echo '<option value="'.$removeQuotes =str_replace("'","",$value).'">'.$removeQuotes=str_replace("'","",$value).'</option>'; //remove the quotes from the enum values
			 }
			 
			 echo '</select> <br />'; */
			 
			 
		   ?>
		   
		   <p>&nbsp;</p>
		   
		   <label>Postcode*:</label> <input type="text" name="postcode" required /> <br/><br/>
		   
		   <label>Country*:</label> <input type="text" name="country" required /> <br/><br/>
		   
		   <label>Phone:</label> <input type="text" name="phone" /> <br/><br/>
		   
		   <label>Mobile:</label> <input type="text" name="mobile" /> <br/><br/>
	
	       <label>Email*:</label> <input type="email" name="email" required/> <br/><br/>
		   
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
			 
			    echo "<option value='' > Please select </option>";
			 
			 foreach($enumValues as $value)
			 {
			    echo '<option value="'.$removeQuotes =str_replace("'","",$value).'">'.$removeQuotes=str_replace("'","",$value).'</option>'; //remove the quotes from the enum values
			 }
			 
			 echo '</select> ';
			 
			 
		   ?>
		   <br /></br>
           
		   <p>Subscribe to weekly email newsletter?</p>
		   
		   <label>Yes</label> <input type="radio" name="newsletter" value="Y" checked /> <br/>
		   
		   <label>No</label> <input type="radio" name="newsletter" value="N" checked /> <br/><br/></br>
		   
		   <label>Image:</label> <input type="file" name="image" /> <br/>
		   
		   <p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb. </p></br>
		   
		   <p><input type="submit" name="registration" value="Create New Account" /></p>
    </form>
	
	</section> <!--end content-->

<?php
    include "../includes/footer.php";
?>
		   
		   
	
	
	
	