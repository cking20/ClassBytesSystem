<?php

/*** begin the session ***/
session_start();

if(!isset($_SESSION['username']))
{
    $message = 'You must be logged in to access this page';
	header("Location: index.php");
}
else
{
    try
    {
        if(!empty($_POST['submit']))
		{
					$error = false;
					
					$username = $_SESSION['username'];
					
					$cCode = trim($_POST['cCode']);
						if(empty($cCode))
						{
								$cCode_error = "Please enter a class code";
								$error = true;
						}
					
					$cName = trim($_POST['cName']);
						if(empty($cName))
						{
								$cName_error = "Please enter a class name";
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
			if(false === $error){		
					
				$mysql_hostname = 'localhost';
				$mysql_username = 'College_Bytes';
				$mysql_password = 'Rhino';
				$mysql_dbname = 'CollegeBytes';

				$message = '';

				$query = "INSERT INTO Classes (`Class_Name`, `Class_Desc`, `Sun`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Start_Time`, `End_Time`, `Test_Weight`, `Quiz_Weight`, `HW_Weight`, `Lab_Weight`,`Room`, `User_ID`) 
							VALUES ('$cCode', '$cName', '$uDay', '$mDay', '$tDay', '$wDay', '$rDay', '$fDay', '$sDay', '$sTime', '$eTime', '$tWeight', '$qWeight', '$hwWeight', '$lWeight', '$roomNumber', '$username')";
			
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
							echo "<p>You have successfully entered the $cName into the database.</p>";
						}
						else
						{
							echo "Error entering $cName into the database: " . mysqli_error()."<br>";
						}
					
				$link->close();
			}
		}
	}
	catch (Exception $e)
    {
        $message = 'We are unable to process your request. Please try again later"';
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
			<h3>Add A New Class</h3>
			<p>To add a new class, please fill out the fields below.  If you do not have or do not want to use a weighted grading 
			scheme, leave the weight fields empty, and the system will assume simple averaging for your grades.</p>
		<fieldset>
			<label for= "cName">Class Catalog Code:<br> <input type= "text" name="cCode"></label> </br></br>
			<span class="error"><?php echo $cCode_error ?></br></span>
			
			<label for= "cName">Class Name:<br> <input type= "text" name="cName"></label> </br></br>
			<span class="error"><?php echo $cName_error ?></br></span>
			
			<label for= "Days">Days: </label><br> 
			<span class='error'><?php echo $day_error ?></span></br>
					
                    
					<label><input type = "checkbox" value = "1" name = 'uDay' />Sunday</label></br>
					<label><input type = "checkbox" value = "1" name = 'mDay' />Monday</label></br>
					<label><input type = "checkbox" value = "1" name = 'tDay' />Tuesday</label></br>
					<label><input type = "checkbox" value = "1" name = 'wDay' />Wednesday</label></br>
					<label><input type = "checkbox" value = "1" name = 'rDay' />Thursday</label></br>
					<label><input type = "checkbox" value = "1" name = 'fDay' />Friday</label></br>
					<label><input type = "checkbox" value = "1" name = 'sDay' />Saturday</label></br>
					
			</br>
			<p>Class Times - Use 24 hour time format, i.e., 3:00 PM would be 15:00</p></br>
			<label for= "sTime">Start Time:<br> <input type= "time" name="sTime"></label> </br></br>
			<span class="error"><?php echo $sTime_error ?></br></span>

			<label for= "eTime">End Time:<br> <input type= "time" name="eTime"></label> </br></br>
			<span class="error"><?php echo $eTime_error ?></br></span>
			<p>Classwork Grade Weighting - Leave blank to assume simple averaging</p></br>
			<label for= "tWeight">Test Weight:<br> <input type= "text" name="tWeight"></label> </br></br>
			<span class="error"><?php echo $tWeight_error ?></br></span>
			
			<label for= "qWeight">Quiz Weight:<br> <input type= "text" name="qWeight"></label> </br></br>
			<span class="error"><?php echo $qWeight_error ?></br></span>
			
			<label for= "hwWeight">Home Work Weight:<br> <input type= "text" name="hwWeight"></label> </br></br>
			<span class="error"><?php echo $hwWeight_error ?></br></span>
			
			<label for= "lWeight">Lab Weight:<br> <input type= "text" name="lWeight"></label> </br></br>
			<span class="error"><?php echo $lWeight_error ?></br></span>
			
			<label for= "roomNumber">Room Number:<br> <input type= "text" name="roomNumber"></label> </br></br>
			<span class="error"><?php echo $rmNo_error ?></br></span>
			
			<input type="submit" name="submit" value="Submit"/>
			</fieldset>

</form>		
		
		

	</main>
	
<footer>
	<a href = '#top'>Back To Top</a>
	
</footer>	
	
</body>
</html>

