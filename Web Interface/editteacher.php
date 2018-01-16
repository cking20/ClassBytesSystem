<?php

/*** begin the session ***/
session_start();

//Global variable for session and class name to edit
$username = $_SESSION['username'];
$editClass = $_POST['className'];

//Checks to see if the user is already logged in, boots to index if not
if(!isset($_SESSION['username']))
{
    $message = 'You must be logged in to access this page';
	header("Location: index.php");
}

//Perfomr dB query of all user teacher contacts prior to user action to provide pre-filled form fields
elseif(empty($_POST['submit']))
{
	$mysql_hostname = 'localhost';
	$mysql_username = 'College_Bytes';
	$mysql_password = 'Rhino';
	$mysql_dbname = 'CollegeBytes';

	$connection = mysql_connect($mysql_hostname, $mysql_username, $mysql_password) or die ("Couldn't connect to server."); 
	$db = mysql_select_db('CollegeBytes', $connection) or die ("Couldn't select database.");

		$data = "SELECT `Class_Name`,`Teacher_Name`, `Teacher_Phone`, `Teacher_Office`, `Teacher_Email` FROM Teacher_Contact WHERE Class_Name = '$editClass' AND User_ID = '$username'"; 
		$edit = mysql_query($data);
		$change = mysql_fetch_array($edit);
		
	mysql_close($connection);
}
else
{
		//Upon user action in posting a teacher edit, validates all data fields
        if(!empty($_POST['submit']))
		{
					$error = false;
					$oldName = trim($_POST['oldName']);
					$tName = trim($_POST['teachname']);
						if(empty($tName))
						{
								$tName_error = "Please enter an instructor name";
								$error = true;
						}
					$phNum = trim($_POST['phNum']);
						if(empty($phNum))
						{
								$phNum_error = "Please enter a phone number";
								$error = true;
						}
					$ofcNum = trim($_POST['ofcNum']);
						if(empty($ofcNum))
						{
								$ofcNum_error = "Please enter an office number";
								$error = true;
						}
					$emailAdd = trim($_POST['emailAdd']);
						if(empty($emailAdd))
						{
								$emailAdd_error = "Please enter an email address";
								$error = true;
						}
				
			//If all data fields are valid, moves new data into an update query to update the teacher contact information
			if(false === $error){		
					
				$mysql_hostname = 'localhost';
				$mysql_username = 'College_Bytes';
				$mysql_password = 'Rhino';
				$mysql_dbname = 'CollegeBytes';
				
				$message = '';
				
				$connection = mysql_connect($mysql_hostname, $mysql_username, $mysql_password) or die ("Couldn't connect to server."); 
				$db = mysql_select_db('CollegeBytes', $connection) or die ("Couldn't select database.");
																																									////////THIS IS NEW AND A TEST/////////////
				$query1 = "UPDATE Teacher_Contact SET Teacher_Name = '$tName', Teacher_Phone = '$phNum', Teacher_Office = '$ofcNum', Teacher_Email = '$emailAdd' WHERE Class_Name = '$oldName' AND User_ID = '$username'";
	
				$set1 = mysql_query($query1);
				$query2 = "UPDATE `Classes` SET `Teach_ID` = '$tName' WHERE `Class_Name` = '$oldName'"; 
				$set2 = mysql_query($query2);
				
				mysql_close($connection);
				
	header("Location: dashboard.php");
			}
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
		<!--start of web content/-->
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
		

<form name = "feedback" id = "addTeacher" action = "?" method ="post">
<h3>Edit an Instructor</h3>
<p>Edit any fields you desire, and click 'submit' to confirm your changes.</p>
	<fieldset>
	<!--/new-->
		<label><input type = "hidden" name = "oldName" value = <?php echo $change[Class_Name] ?>></label>
	<!--/-->		
		<label for= "cName">Class Catalog Code: <?php echo $editClass; ?></label> </br></br>
		
		<label for= "Name">Name: </label><br> <input name = "teachname" type = "text" value="<?php echo $change[Teacher_Name]?>"></br>
		<span class="error"><?php echo $tName_error ?></br></span>

		<label for="Phone Number">Phone Number: <br><input type="tel" name="phNum" value="<?php echo $change[Teacher_Phone]?>"></label></br></br>
		<span class="error"><?php echo $phNum_error ?></br></span>

		<label for= "Office Number">Office Number:<br> <input type= "text" name="ofcNum" value="<?php echo $change[Teacher_Office]?>"></label> </br></br>
		<span class="error"><?php echo $ofcNum_error ?></br></span>

		<label for= "Email Address">Email Address:<br> <input type= "email" name="emailAdd" value="<?php echo $change[Teacher_Email]?>"></label> </br></br>
		<span class="error"><?php echo $emailAdd_error ?></br></span>

		<input type="submit" name="submit" value="Submit"/>
	</fieldset>
</form>
<div><span><?php echo $confMsg; ?></span></div>
</main>
</body>
</html>
