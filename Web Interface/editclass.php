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
//Perfomr dB query of all user classes prior to user action to provide pre-filled form fields
elseif(empty($_POST['submit']))
{
	$mysql_hostname = 'localhost';
	$mysql_username = 'College_Bytes';
	$mysql_password = 'Rhino';
	$mysql_dbname = 'CollegeBytes';

	$connection = mysql_connect($mysql_hostname, $mysql_username, $mysql_password) or die ("Couldn't connect to server."); 
	$db = mysql_select_db('CollegeBytes', $connection) or die ("Couldn't select database.");
		
		$data = "SELECT `Class_Name`, `Class_Desc`, `Sun`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Start_Time`, `End_Time`, `Test_Weight`, `Quiz_Weight`, `HW_Weight`, `Lab_Weight`,`Room` FROM Classes WHERE Class_Name = '$editClass' AND User_ID = '$username'"; 
		$edit = mysql_query($data);
		$change = mysql_fetch_array($edit);
		
		if($change[Sun] == '1') $uChk = 'checked="checked"';
		if($change[Mon] == '1') $mChk = 'checked="checked"';
		if($change[Tue] == '1') $tChk = 'checked="checked"';
		if($change[Wed] == '1') $wChk = 'checked="checked"';
		if($change[Thu] == '1') $rChk = 'checked="checked"';
		if($change[Fri] == '1') $fChk = 'checked="checked"';
		if($change[Sat] == '1') $sChk = 'checked="checked"';
		
	mysql_close($connection);
}

else
{
	//Upon user action in posting an class edit, validates all data fields
	if(!empty($_POST['submit']))
		{
			$error = false;
			$oldName = trim($_POST['oldName']);
			$cName = trim($_POST['cName']);
				if(empty($cName))
				{
						$cName_error = "Please enter a description";
						$error = true;
				}
				
				if(empty($_POST['uDay']) && empty($_POST['mDay']) && empty($_POST['tDay']) && empty($_POST['wDay']) && empty($_POST['rDay']) && empty($_POST['fDay']) && empty($_POST['sDay']))
				{
					$day_error = "Please check at least one day for your class";
					$error = true;
				}
				else
				{
					$uDay = $_POST['uDay'];
						if($uDay != "1")
							{
								$uDay = "0";
							}
					$mDay = $_POST['mDay'];
						if($mDay != "1")
							{
								$mDay = "0";
							}
					$tDay = $_POST['tDay'];
						if($tDay != "1")
							{
								$tDay = "0";
							}
					$wDay = $_POST['wDay'];
						if($wDay != "1")
							{
								$wDay = "0";
							}
					$rDay = $_POST['rDay'];
						if($rDay != "1")
							{
								$rDay = "0";
							}
					$fDay = $_POST['fDay'];
						if($fDay != "1")
							{
								$fDay = "0";
							}
					$sDay = $_POST['sDay'];	
						if($sDay != "1")
							{
								$sDay = "0";
							}
				}
				
			$sTime = trim($_POST['sTime']);
				if(empty($sTime))
				{
						$sTime_error = "Please enter a start time";
						$error = true;
				}
			$eTime = trim($_POST['eTime']);
				if(empty($eTime))
				{
						$eTime_error = "Please enter an end time";
						$error = true;
				}
			$tWeight = trim($_POST['tWeight']);
				if(empty($tWeight))
				{
						$tWeight = "100";
				}
			$qWeight = trim($_POST['qWeight']);
				if(empty($qWeight))
				{
						$qWeight = "100";
				}
			$hwWeight = trim($_POST['hwWeight']);
				if(empty($hwWeight))
				{
						$hwWeight = "100";
				}
			$lWeight = trim($_POST['lWeight']);
				if(empty($lWeight))
				{
						$lWeight = "100";
				}
			$roomNumber = trim($_POST['roomNumber']);
				if(empty($roomNumber))
				{
						$rmNo_error = "Please enter a room number for your class";
						$error = true;
				}
			//If all data fields are valid, moves new data into an update query to update the class information	
			if(false === $error)
			{		
					
				$mysql_hostname = 'localhost';
				$mysql_username = 'College_Bytes';
				$mysql_password = 'Rhino';
				$mysql_dbname = 'CollegeBytes';

				$message = '';

				$connection = mysql_connect($mysql_hostname, $mysql_username, $mysql_password) or die ("Couldn't connect to server."); 
				$db = mysql_select_db('CollegeBytes', $connection) or die ("Couldn't select database.");
			
				$query = "UPDATE Classes SET Class_Desc = '$cName', Sun = '$uDay', Mon = '$mDay', Tue = '$tDay', Wed = '$wDay', Thu = '$rDay', Fri = '$fDay', Sat = '$sDay', Start_Time = '$sTime', End_Time = '$eTime', Test_Weight = '$tWeight', Quiz_Weight = '$qWeight', HW_Weight = '$hwWeight', Lab_Weight = '$lWeight', Room = '$roomNumber' WHERE Class_Name = '$oldName' AND User_ID = '$username'"; 
	
				$set = mysql_query($query);
				
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
		
		
			<form name = "feedback" id = "feedbackform" action = "?" method ="post">
			<h3>Edit Class</h3>
		<fieldset>
			<label><input type = "hidden" name = "oldName" value = <?php echo $change[Class_Name] ?>></label>
			
			<label for= "cName">Class Catalog Code: <?php echo $change[Class_Name]?></label> </br></br>
			
			<label for= "cName">Class Description:<br> <input type= "text" name="cName" value="<?php echo $change[Class_Desc]?>"></label> </br></br>
			<span class="error"><?php echo $cName_error ?></br></span>
			
			<label for= "Days">Days: </label><br> 
			<span class='error'><?php echo $day_error ?></span></br>
					
                    
					<label><input type = "checkbox" value = "1" <?php echo $uChk; ?> name = 'uDay' />Sunday</label></br>
					<label><input type = "checkbox" value = "1" <?php echo $mChk; ?> name = 'mDay' />Monday</label></br>
					<label><input type = "checkbox" value = "1" <?php echo $tChk; ?> name = 'tDay' />Tuesday</label></br>
					<label><input type = "checkbox" value = "1" <?php echo $wChk; ?> name = 'wDay' />Wednesday</label></br>
					<label><input type = "checkbox" value = "1" <?php echo $rChk; ?> name = 'rDay' />Thursday</label></br>
					<label><input type = "checkbox" value = "1" <?php echo $fChk; ?> name = 'fDay' />Friday</label></br>
					<label><input type = "checkbox" value = "1" <?php echo $sChk; ?> name = 'sDay' />Saturday</label></br>
					
			</br>
			<p>Class Times - Use 24 hour time format, i.e., 3:00 PM would be 15:00</p></br>
			<label for= "sTime">Start Time:<br> <input type= "time" name="sTime" value="<?php echo $change[Start_Time]?>"></label> </br></br>
			<span class="error"><?php echo $sTime_error ?></br></span>

			<label for= "eTime">End Time:<br> <input type= "time" name="eTime" value="<?php echo $change[End_Time]?>"></label> </br></br>
			<span class="error"><?php echo $eTime_error ?></br></span>
			<p>Classwork Grade Weighting - Leave blank to assume simple averaging</p></br>
			<label for= "tWeight">Test Weight:<br> <input type= "text" name="tWeight" value="<?php echo $change[Test_Weight]?>"></label> </br></br>
			<span class="error"><?php echo $tWeight_error ?></br></span>
			
			<label for= "qWeight">Quiz Weight:<br> <input type= "text" name="qWeight" value="<?php echo $change[Quiz_Weight]?>"></label> </br></br>
			<span class="error"><?php echo $qWeight_error ?></br></span>
			
			<label for= "hwWeight">Home Work Weight:<br> <input type= "text" name="hwWeight" value="<?php echo $change[HW_Weight]?>"></label> </br></br>
			<span class="error"><?php echo $hwWeight_error ?></br></span>
			
			<label for= "lWeight">Lab Weight:<br> <input type= "text" name="lWeight" value="<?php echo $change[Lab_Weight]?>"></label> </br></br>
			<span class="error"><?php echo $lWeight_error ?></br></span>
			
			<label for= "roomNumber">Room Number:<br> <input type= "text" name="roomNumber" value="<?php echo $change[Room]?>"></label> </br></br>
			<span class="error"><?php echo $rmNo_error ?></br></span>
			
			<input type="submit" name="submit" value="Submit"/>
			</fieldset>
			<?php echo $message; ?>

</form>		
		
		

	</main>
	
<footer>
	<a href = '#top'>Back To Top</a>
	
</footer>	
	
</body>
</html>

