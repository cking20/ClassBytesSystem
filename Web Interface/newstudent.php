<?php
			if(!empty($_POST['submit']))
				{
					$error = false;
					
					$FirstName = trim($_POST['FirstName']);
						if(empty($FirstName))
							{
								$FirstName_error = "Please enter your first name";
								$error = true;
							}
					$LastName = trim($_POST['LastName']);
						if(empty($LastName))
							{
								$LastName_error = "Please enter your last name";
								$error = true;
							}
					$Email = trim($_POST['Email']);
						if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $Email))
							{
								$Email_error = "E-mail address not valid";
								$error = true;
							}
						elseif(empty($Email))
							{
								$Email_error = "Please enter your email address";
								$error = true;
							}
					$Password = trim($_POST['Password']);
						if(empty($Password))
							{
								$Password_error = "Please enter your new Password";
								$error = true;
							}
			if(false === $error)
				{
					
					$mysql_hostname = 'localhost';
					$mysql_username = 'College_Bytes';
					$mysql_password = 'Rhino';
					$mysql_dbname = 'CollegeBytes';
					
					$Fname = $_POST['FirstName'];
					$Lname = $_POST['LastName'];
					$Email = $_POST['Email'];
					$Pass = $_POST['Password'];
					$message = '';

					$query = "INSERT INTO Student (`Student_ID`, `Password`, `User_First_Name`, `User_Last_Name`, `User_Email`) VALUES ('$Email', '$Pass', '$Fname', '$Lname', '$Email')";
				
						echo ($query."<br>");

						$link = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

						if(!$link)
							{
								die('Connect failed: ' . mysqli_error());
							}

						echo 'Connected successfully to mySQL. <br>';

						$link->select_db("CollegeBytes");

						echo ("Selected the College Bytes database. <br>");
					
					
					
					
						if($result = $link->query($query))
							{
								$message = "You have successfully registered your account. Welcome to Class Bytes, $Fname!  Please wait while we transfer you to our login page...";
								sleep(4);
								header('Location: index.php');
							}
							else
							{
								$message = 'We are unable to process your request. Please try again later"';
							}
				
					$link->close();
					header("Location: dashboard.php");
				}
					{
						
					}
				}
?> 

<!DOCTYPE html>
<html lang="en-us">

<head>
  <title>CollegeBytes!</title>
  <link rel="stylesheet" type="text/css" href="cbmain.css" />
  
</head>
	
<body>
	<main>
		<a name = "top"></a>
		<!--/-->
		
		<header title="College Bytes"> 
			<div class = "logo">
				<a href="dashboard.php">
					<img id="logoImage" src="images/logo.png" alt = "Logo" > 
				</a>
			</div>
		
		
		<!--Big text with a faded image behind it is the first 
			image seen when visiting the site/-->
		
			<div class="navigation">	
				<nav>
					<ul id = "mainList">
						<li class = "dropDown" id="classes" ><a href = "#">Classes</a>
							<ul>
								<li><a href = "newclass.php">Add New Class</a></li>
								<li><a href = "newstudentcontact.php">Add Contact</a></li>
								<li><a href = "newteacher.php">Add Teacher</a></li>
								
								
							</ul>
						</li>
				
						<li class = "dropDown" id="contacts"><a href = "#">Obligation</a>
							<ul>
								<li><a href = "newassignment.php">Add New Class Obligation</a></li>
							</ul>
						</li>
				
						<li class = "dropDown" id="alerts"><a href = "#">Menu</a>
							<ul>
								<li><a href = "learnmore.php">Learn More</a></li>
								<li><a href = "faq.php">Frequently Asked Questions</a></li>
								
							</ul>	
						</li>
						<li class = "dropDown" id="alerts"><a href = "logout.php" >Log Out</a></li>
					</ul>
				</nav>
			</div>
		</header>
		
<form name = "newuser" id = "newuserform" action = "?" method ="post">
<h3>Account Registration</h3>
<p>Please fill out the following fields and click 'Submit'.  You will then be prompted to log in with your new username and password.</p>
	<fieldset>
		<label for= "FName">First Name: </label><br> <input name = "FirstName" type = "text" value='<?php echo htmlentities($FirstName) ?>'></br>
		<span class="error"><?php echo $FirstName_error ?></br></span>
						
		<label for= "LName">Last Name: </label><br> <input name = "LastName" type = "text" value='<?php echo htmlentities($LastName) ?>'></br>
		<span class="error"><?php echo $LastName_error ?></br></span>
			
		<label for="Email">Email(This will be your User Name): <br><input type="text" name="Email" value='<?php echo htmlentities($Email) ?>'></label></br>
		<span class="error"><?php echo $Email_error ?></br></span>
		
		<label for= "Pass">Password: </label><br> <input name = "Password" type = "text" value='<?php echo htmlentities($Password) ?>'></br>
		<span class="error"><?php echo $Password_error ?></br></span>
		
			
		<input type="submit" name="submit" value="Submit"/>
	</fieldset>
</form>

<p><?php echo $message; ?></p>
	</main>
</body>
