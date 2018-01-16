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
					
					
					
					$Gname = trim($_POST['AssName']);
						if(empty($Gname))
						{
								$Gname_error = "Please the name of the Assignment";
								$error = true;
						}
					$cName = trim($_POST['className']);
						if(empty($cName))
						{
								$Gname_error = "Please select a class for your assignment";
								$error = true;
						}
					$Gtype = trim($_POST['GradeType']);
						if(empty($Gtype))
						{
								$Gtype_error = "Please enter the grade type";
								$error = true;
						}
				    $Ddate = trim($_POST['DueDate']);
						if(empty($Ddate))
						{
								$Ddate_error = "Please enter the Date";
								$error = true;
						}
					$Grd = trim($_POST['Grade']);
						if(!isset($Grd))
						{
								$Grd_error = "Please enter the grade Current Grade";
								$error = true;
						}
					$Cmplt = trim($_POST['Complete']);
						if(empty($Cmplt))
						{
								$Cmplt_error = "Please enter if the Assignment is complete";
								$error = true;
						}
			if(false === $error){		
					
				$mysql_hostname = 'localhost';
				$mysql_username = 'College_Bytes';
				$mysql_password = 'Rhino';
				$mysql_dbname = 'CollegeBytes';
				
				$message = '';
				$query = "INSERT INTO Assignments (`Assignment_Name`, `Class_Name`, `Grade_Type`, `Completion`, `Due_Date`, `Grade`, `User_ID`) 
							VALUES ('$Gname', '$cName', '$Gtype', '$Cmplt', '$Ddate', '$Grd', '$username')";
			
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
							echo "<p>You have successfully entered the $Gname into the database.</p>";
						}
						else
						{
							echo "Error entering $Gname into the database: " . mysqli_error()."<br>";
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
//}

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
		
		<form name = "assignment" id = "assignmentform" action = "?" method ="post">
		<h3>Add Assignment</h3>
		<p>To add an assignment, please fill out all of the fields on this form.  For assignments that are not complete, 
		click 'No' for completion, and leave the grade field blank.  You can edit the completion and grade on the 'Edit 
		Assignment' page once you have completed it.</p>
	<fieldset>
		<label for= "Gname">Assignment Name:<br> <input type= "text" name="AssName"></label> </br></br>
		<span class="error"><?php echo $Gname_error ?></br></span>
		
		<p>Select a class for this assignment:</p>
		<select id="class" name="className">

		<?php

		$mysqlserver="localhost";
		$mysqlusername="College_Bytes";
		$mysqlpassword="Rhino";
		$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());

		$dbname = 'CollegeBytes';
		mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

		$classquery="SELECT Class_Name FROM Classes WHERE User_ID = '$username'";
		$result=mysql_query($classquery) or die ("Query to get data failed: ".mysql_error());

		echo "<option value=\"Select\"></option>";
		while ($row=mysql_fetch_array($result))				
		{
			$cName=$row[Class_Name];
			echo "<option value = " . $row[Class_Name] . ">" . $row[Class_Name] . "</option>";
		}
			
		?>

		</select></br></br>
		<label for= "Gtype">Grade Type: </label><br> 
			<select name = "GradeType" value='<?php echo htmlentities($Gtype) ?>'>
				<option <?php echo $Gtype=='Home Work'?'selected':''; ?> >Home Work</option>
				<option <?php echo $Gtype=='Lab'?'selected':''; ?>>Lab</option>
				<option <?php echo $Gtype=='Quiz'?'selected':''; ?>>Quiz</option>
				<option <?php echo $Gtype=='Test'?'selected':''; ?>>Test</option>
			</select>
		</label>
		<span class="error"><?php echo $Gtype_error ?></br></span>
		<br> 
		<label for="Ddate">Due Date(YYYY-MM-DD): <br><input type="datetime" name="DueDate"></label></br></br>
		<span class="error"><?php echo $Ddate_error ?></br></span>
		<label for= "Grd">Grade:<br> <input type= "text" name="Grade"></label> </br></br>
		<span class="error"><?php echo $Grd_error ?></br></span>
		<label for= "Cmplt">Completion:</label> <br> 
			<label class="radiolabel"><input type="radio" name="Complete" value="No" <?php echo ($Cmplt=='No')? 'checked':''; ?> />No</label>
			<label class="radiolabel"><input type="radio" name="Complete" value="Yes" <?php echo ($Cmplt=='Yes')? 'checked':''; ?> />Yes</label>
		<span class="error"><?php echo $Cmplt_error ?></br></span>
		</br></br>
			
</fieldset>
<input type="submit" name="submit" value="Submit"/>