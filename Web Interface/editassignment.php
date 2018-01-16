<?php

/*** begin the session ***/
session_start();

//Global variables for session and assignment name to edit
$username = $_SESSION['username'];
$editAss = $_POST['assName'];
 
//Checks to see if the user is already logged in, boots to index if not
if(!isset($_SESSION['username']))
{
    $message = 'You must be logged in to access this page';
	header("Location: index.php");
}
//Perfomr dB query of all user assignments prior to user action to provide pre-filled form fields
elseif(empty($_POST['submit']))
{
	$mysql_hostname = 'localhost';
	$mysql_username = 'College_Bytes';
	$mysql_password = 'Rhino';
	$mysql_dbname = 'CollegeBytes';

	$connection = mysql_connect($mysql_hostname, $mysql_username, $mysql_password) or die ("Couldn't connect to server."); 
	$db = mysql_select_db('CollegeBytes', $connection) or die ("Couldn't select database.");
/////THIS IS WHWERE THE ERROR IS. $data IS NOT GETTING ANY VALuES		
		$data = "SELECT `Assignment_ID`, `Assignment_Name`, `Class_Name`, `Grade_Type`, `Completion`, `Due_Date`, `Grade`  FROM Assignments WHERE Assignment_ID = '$editAss' AND User_ID = '$username'"; 
var_dump($data);
		$edit = mysql_query($data);
		$change = mysql_fetch_array($edit);
var_dump($change);
		
	mysql_close($connection);
}

else
{
	//Upon user action in posting an assignment edit, validates all data fields
	if(!empty($_POST['submit']))
		{
					$error = false;
					$oldAss = trim($_POST['oldAss']);
					
					$Gname = trim($_POST['Gname']);
						if(empty($Gname))
						{
								$Gname_error = "Please the name of the Assignment";
								$error = true;
						}
					$Gtype = trim($_POST['Gtype']);
						if(empty($Gtype))
						{
								$Gtype_error = "Please enter the grade type";
								$error = true;
						}
				    $Ddate = trim($_POST['Ddate']);
						if(empty($Ddate))
						{
								$Ddate_error = "Please enter the Date";
								$error = true;
						}
					$Grd = trim($_POST['Grd']);
						if(!isset($Grd))
						{
								$Grd_error = "Please enter the grade Current Grade";
								$error = true;
						}
					$Cmplt = trim($_POST['Cmplt']);
						if(empty($Cmplt))
						{
								$Cmplt_error = "Please enter if the Assignment is complete";
								$error = true;
						}
			//If all data fields are valid, moves new data into an update query to update the assignment information
			if(false === $error){		
					
				$mysql_hostname = 'localhost';
				$mysql_username = 'College_Bytes';
				$mysql_password = 'Rhino';
				$mysql_dbname = 'CollegeBytes';
				
				$message = '';

				$connection = mysql_connect($mysql_hostname, $mysql_username, $mysql_password) or die ("Couldn't connect to server."); 
				$db = mysql_select_db('CollegeBytes', $connection) or die ("Couldn't select database.");
			
				$query = "UPDATE Assignments SET Assignment_Name = '$Gname', Grade_Type = '$Gtype', Due_Date = '$Ddate', Grade = '$Grd', Completion = '$Cmplt' WHERE Assignment_ID = '$oldAss' AND User_ID = '$username'"; 
	var_dump($query);	
				$set = mysql_query($query);
	var_dump($set);			
				mysql_close($connection);
			
	//header("Location: dashboard.php");
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
		
		
			<form name = "feedback" id = "feedbackform" action = "?" method ="post">
			<h3>Edit Assignment</h3>
				<fieldset>
			<label><input type = "hidden" name = "oldAss" value = <?php echo $change[Assignment_ID] ?>></label>
			
			<label for= "Gname">Assignment Name:<br> <input type= "text" name="Gname" value="<?php echo $change[Assignment_Name]?>"></label> </br></br>
			<span class="error"><?php echo $Gname_error ?></br></span>
		
		</select></br></br>
		<label for= "Gtype">Grade Type: </label><br> 
			<select name = "Gtype" value="<?php echo $change[Grade_Type]?>">
<!--////////////Need to add default selection based on previous user input///////////////////////////////////////////////////////////-->
				<option <?php echo $Gtype=='Home Work'?'selected':''; ?> >Home Work</option>
				<option <?php echo $Gtype=='Lab'?'selected':''; ?>>Lab</option>
				<option <?php echo $Gtype=='Quiz'?'selected':''; ?>>Quiz</option>
				<option <?php echo $Gtype=='Test'?'selected':''; ?>>Test</option>
			</select>
		</label>
		<span class="error"><?php echo $Gtype_error ?></br></span>
		<br> 
		<label for="Ddate">Due Date(YYYY-MM-DD): <br><input type="datetime" name="Ddate" value="<?php echo $change[Due_Date]?>"></label></br></br>
		<span class="error"><?php echo $Ddate_error ?></br></span>
		
		<label for= "Grd">Grade:<br> <input type= "text" name="Grd" value="<?php echo $change[Grade]?>"></label> </br></br>
		<span class="error"><?php echo $Grd_error ?></br></span>
<!--////////////Need to add default selection based on previous user input////////////////////////////////////////////////////-->	
		<label for= "Cmplt">Completion:</label> <br> 
			<label class="radiolabel"><input type="radio" name="Cmplt" value="No" <?php echo ($Cmplt=='No')? 'checked':''; ?> />No</label>
			<label class="radiolabel"><input type="radio" name="Cmplt" value="Yes" <?php echo ($Cmplt=='Yes')? 'checked':''; ?> />Yes</label>
		<span class="error"><?php echo $Cmplt_error ?></br></span>
		</br></br>
			
			</fieldset>
			<input type="submit" name="submit" value="Submit"/>
			<?php echo $message; ?>
		</form>		
		
		

	</main>
	
<footer>
	<a href = '#top'>Back To Top</a>
	
</footer>	
	
</body>
</html>

