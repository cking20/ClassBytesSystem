<?php

/*** begin the session ***/
session_start();
$username = $_SESSION['username'];
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
					
					
					
					$tName = trim($_POST['name']);
						if(empty($tName))
						{
								$tName_error = "Please enter an instructor name";
								$error = true;
						}
						
					$cName = trim($_POST['className']);
						if(empty($cName))
						{
								$cName_error = "Please select a class";
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
				    
			if(false === $error){		
					
				$mysql_hostname = 'localhost';
				$mysql_username = 'College_Bytes';
				$mysql_password = 'Rhino';
				$mysql_dbname = 'CollegeBytes';
				
				$message = '';

				$query = "INSERT INTO Teacher_Contact (`Teacher_Name`, `Class_Name`, `Teacher_Phone`, `Teacher_Office`, `Teacher_Email`, `User_ID`) 
							VALUES ('$tName', '$cName', '$phNum', '$ofcNum', '$emailAdd', '$username')";
				$tQuery = "UPDATE `Classes` SET `Teach_ID` = '$tName' WHERE `Class_Name` = '$cName'";
			
					echo ($query."<br>");

					$link = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

					if(!$link)
						{
							die('Connect failed: ' . mysqli_error());
						}

					echo 'Connected successfully to mySQL. <br>';

					$link->select_db("CollegeBytes");

					echo ("Selected the College Bytes database. <br>");
					
					$confMsg = '';
					if($result = $link->query($query))
						{
							echo "<p>You have successfully entered the $cName into the database.</p>";
							$confMsg = "You have successfully added $tName, teaching $cName, to your account";
						}
						else
						{
							echo "Error entering $cName into the database: " . mysqli_error()."<br>";
						}
						
					if($tResult = $link->query($tQuery))
						{
							echo "<p>You have successfully entered the $tName into the database.</p>";
						}
						else
						{
							echo "Error entering $tName into the database: " . mysqli_error()."<br>";
						}
					
				$link->close();
				header("Location: dashboard.php");
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
		
		
<form name = "feedback" id = "addTeacher" action = "?" method ="post">
<h3>Add an Instructor</h3>
<p>You may only add instructors for classes you have entered into your schedule.  If no classes are available for 
selection, there are no available classes that do not have instructors assigned.  To edit or delete an instructor, please 
go to the relavant class page and select "Edit" or "Delete".</p>
	<fieldset>
		<label for= "Name">Name: </label><br> <input name = "name" type = "text"></br>
		<span class="error"><?php echo $tName_error ?></br></span>

		<p>Select a class for this instructor:</p>
		<select id="class" name="className">

		<?php

		$mysqlserver="localhost";
		$mysqlusername="College_Bytes";
		$mysqlpassword="Rhino";
		$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());

		$dbname = 'CollegeBytes';
		mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

		$classquery="SELECT Class_Name FROM Classes WHERE User_ID = '$username' AND `Teach_ID` IS NULL";
		$result=mysql_query($classquery) or die ("Query to get data failed: ".mysql_error());

		echo "<option value=\"Select\"></option>";
		while ($row=mysql_fetch_array($result))				
		{
			$cName=$row[Class_Name];
			echo "<option value = " . $row[Class_Name] . ">" . $row[Class_Name] . "</option>";
		}
			
		?>

		</select></br></br>

		<label for="Phone Number">Phone Number: <br><input type="tel" name="phNum"></label></br></br>
		<span class="error"><?php echo $phNum_error ?></br></span>

		<label for= "Office Number">Office Number:<br> <input type= "text" name="ofcNum"></label> </br></br>
		<span class="error"><?php echo $ofcNum_error ?></br></span>

		<label for= "Email Address">Email Address:<br> <input type= "email" name="emailAdd"></label> </br></br>
		<span class="error"><?php echo $emailAdd_error ?></br></span>

		<input type="submit" name="submit" value="Submit"/>
	</fieldset>
</form>
<div><span><?php echo $confMsg; ?></span></div>
</main>
</body>
</html>
