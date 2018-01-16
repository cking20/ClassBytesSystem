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
			$Telephone = trim($_POST['Telephone']); 
				if(empty($Telephone))
					{
						$Telephone_error = "Please enter your telephone number";
						$error = true;
					}
			$Address = trim($_POST['Address']);
				if(empty($Address))
					{
						$Address_error = "Please enter your street address";
						$error = true;
					}
			$City = trim($_POST['City']); 
				if(empty($City))
					{
						$City_error = "Please enter your city";
						$error = true;
					}
			$State = trim($_POST['State']);
				if(empty($State))
					{
						$State_error = "Please enter your state";
						$error = true;
					}
			$CardType = trim($_POST['cardtype']);
				if(empty($CardType))
					{
						$CardType_error = "Please select a credit card type";
						$error=true;
					}
				else
					{
						$CardType = $_POST['cardtype'];
					}
			$CardNumber = trim($_POST['CardNumber']); 
				if(empty($CardNumber))
					{
						$CardNumber_error = "Please enter your credit card number";
						$error = true;
					}
			$CardExpDate = trim($_POST['ExpirationDate']);
				if(empty($CardExpDate))
					{
						$CardExpDate_error = "Please enter your credit card expiration date";
						$error = true;
					}
			$CardCCV = trim($_POST['SecurityCode']);
				if(empty($CardCCV))
					{
						$CardCCV_error = "Please enter your credit card CCV";
						$error = true;
					}
			
			if(false === $error)
				{
					$CCFile = "CCFile.txt";
					$Space = "\n";
					$File = fopen($CCFile, 'w+') or die("Unable to open file!");
					fwrite($File, $FirstName."\n");
					fwrite($File, $LastName."\n");
					fwrite($File, $Email."\n");
					fwrite($File, $Telephone."\n");
					fwrite($File, $Address."\n");
					fwrite($File, $City."\n");
					fwrite($File, $State."\n");
					fwrite($File, $CardType."\n");
					fwrite($File, $CardNumber."\n");
					fwrite($File, $CardExpDate."\n");
					fwrite($File, $CardCCV."\n");
					fclose($File);
					
					$Approval = '';
					$RanNum = rand(1, 20);
					if($RanNum == 10)
						{
							$Approval = "CREDIT DISAPPROVED!  Come back when you have some money, scrub!";
						}
					else
						{
							$Approval = "CREDIT APPROVED!\nPlease wait while we forward you to our registration page...";
							sleep(4);
							header('Location: newstudent.php');
						}
				}
		}
	
	
?>
<!DOCTYPE HTML>
<html lang="en-us">

<head>
  <title>CollegeBytes!</title>
  <link rel="stylesheet" type="text/css" href="cbmain.css" />
</head>
	
	<body>
		<main>

<a name = "top"></a>
			<header title="College Bytes"> 
				<div class = "logo">
					<a href="dashboard.php">
						<img id="logoImage" src="images/logo.png" alt = "Logo" > 
					</a>
				</div>
			</header>

	
				<form name = "creditcard" id = "creditcardform" action = "?" method ="post">
				<h3>Online Ordering</h3>
				<p>A subscription to the Class Bytes system costs $6.95 for LIFETIME ACCESS.</p>
				<p>Please enter your payment information below and click the "Submit" button.  All fields are manadatory.</p>
				<p>Upon successful payment, you will be transferred to our registration page.</p>
					<fieldset>
						<label for= "FName">First Name: </label><br> <input name = "FirstName" type = "text" value='<?php echo htmlentities($FirstName) ?>'></br>
						<span class="error"><?php echo $FirstName_error ?></br></span>
						
						<label for= "LName">Last Name: </label><br> <input name = "LastName" type = "text" value='<?php echo htmlentities($LastName) ?>'></br>
						<span class="error"><?php echo $LastName_error ?></br></span>
						
						<label for="Email">Email: <br><input type="text" name="Email" value='<?php echo htmlentities($Email) ?>'></label></br>
						<span class="error"><?php echo $Email_error ?></br></span>
						
						<label for= "Telephone">Telephone:<br> <input type= "text" name="Telephone" value='<?php echo htmlentities($Telephone) ?>'></label> </br>
						<span class="error"><?php echo $Telephone_error ?></br></span>
						
						<label for= "Address">Address:<br> <input type= "text" name="Address" value='<?php echo htmlentities($Address) ?>'></label> </br>
						<span class="error"><?php echo $Address_error ?></br></span>
						
						<label for= "City">City:<br> <input type= "text" name="City" value='<?php echo htmlentities($City) ?>'></label> </br>
						<span class="error"><?php echo $City_error ?></br></span>
						
						<label for= "State">State:</label><br> 
						<select type= "text" name="State" value='<?php echo htmlentities($State) ?>'>
							<option value="">Select State</option>
							<option <?php echo $State=='AL'?'selected':''; ?> >Alabama</option>
							<option <?php echo $State=='AK'?'selected':''; ?> >Alaska</option>
							<option <?php echo $State=='AZ'?'selected':''; ?> >Arizona</option>
							<option <?php echo $State=='AR'?'selected':''; ?> >Arkansas</option>
							<option <?php echo $State=='CA'?'selected':''; ?> >California</option>
							<option <?php echo $State=='CO'?'selected':''; ?> >Colorado</option>
							<option <?php echo $State=='CT'?'selected':''; ?> >Connecticut</option>
							<option <?php echo $State=='DE'?'selected':''; ?> >Delaware</option>
							<option <?php echo $State=='DC'?'selected':''; ?> >District Of Columbia</option>
							<option <?php echo $State=='FL'?'selected':''; ?> >Florida</option>
							<option <?php echo $State=='GA'?'selected':''; ?> >Georgia</option>
							<option <?php echo $State=='HI'?'selected':''; ?> >Hawaii</option>
							<option <?php echo $State=='ID'?'selected':''; ?> >Idaho</option>
							<option <?php echo $State=='IL'?'selected':''; ?> >Illinois</option>
							<option <?php echo $State=='IN'?'selected':''; ?> >Indiana</option>
							<option <?php echo $State=='IA'?'selected':''; ?> >Iowa</option>
							<option <?php echo $State=='KS'?'selected':''; ?> >Kansas</option>
							<option <?php echo $State=='KY'?'selected':''; ?> >Kentucky</option>
							<option <?php echo $State=='LA'?'selected':''; ?> >Louisiana</option>
							<option <?php echo $State=='ME'?'selected':''; ?> >Maine</option>
							<option <?php echo $State=='MD'?'selected':''; ?> >Maryland</option>
							<option <?php echo $State=='MA'?'selected':''; ?> >Massachusetts</option>
							<option <?php echo $State=='MI'?'selected':''; ?> >Michigan</option>
							<option <?php echo $State=='MN'?'selected':''; ?> >Minnesota</option>
							<option <?php echo $State=='MS'?'selected':''; ?> >Mississippi</option>
							<option <?php echo $State=='MO'?'selected':''; ?> >Missouri</option>
							<option <?php echo $State=='MT'?'selected':''; ?> >Montana</option>
							<option <?php echo $State=='NE'?'selected':''; ?> >Nebraska</option>
							<option <?php echo $State=='NV'?'selected':''; ?> >Nevada</option>
							<option <?php echo $State=='NH'?'selected':''; ?> >New Hampshire</option>
							<option <?php echo $State=='NJ'?'selected':''; ?> >New Jersey</option>
							<option <?php echo $State=='NM'?'selected':''; ?> >New Mexico</option>
							<option <?php echo $State=='NY'?'selected':''; ?> >New York</option>
							<option <?php echo $State=='NC'?'selected':''; ?> >North Carolina</option>
							<option <?php echo $State=='ND'?'selected':''; ?> >North Dakota</option>
							<option <?php echo $State=='OH'?'selected':''; ?> >Ohio</option>
							<option <?php echo $State=='OK'?'selected':''; ?> >Oklahoma</option>
							<option <?php echo $State=='OR'?'selected':''; ?> >Oregon</option>
							<option <?php echo $State=='PA'?'selected':''; ?> >Pennsylvania</option>
							<option <?php echo $State=='RI'?'selected':''; ?> >Rhode Island</option>
							<option <?php echo $State=='SC'?'selected':''; ?> >South Carolina</option>
							<option <?php echo $State=='SD'?'selected':''; ?> >South Dakota</option>
							<option <?php echo $State=='TN'?'selected':''; ?> >Tennessee</option>
							<option <?php echo $State=='TX'?'selected':''; ?> >Texas</option>
							<option <?php echo $State=='UT'?'selected':''; ?> >Utah</option>
							<option <?php echo $State=='VT'?'selected':''; ?> >Vermont</option>
							<option <?php echo $State=='VA'?'selected':''; ?> >Virginia</option>
							<option <?php echo $State=='WA'?'selected':''; ?> >Washington</option>
							<option <?php echo $State=='WV'?'selected':''; ?> >West Virginia</option>
							<option <?php echo $State=='WI'?'selected':''; ?> >Wisconsin</option>
							<option <?php echo $State=='WY'?'selected':''; ?> >Wyoming</option>
							<option <?php echo $State=='AS'?'selected':''; ?> >American Samoa</option>
							<option <?php echo $State=='GU'?'selected':''; ?> >Guam</option>
							<option <?php echo $State=='MP'?'selected':''; ?> >Northern Mariana Islands</option>
							<option <?php echo $State=='PR'?'selected':''; ?> >Puerto Rico</option>
							<option <?php echo $State=='UM'?'selected':''; ?> >United States Minor Outlying Islands</option>
							<option <?php echo $State=='VI'?'selected':''; ?> >Virgin Islands</option>
							<option <?php echo $State=='AA'?'selected':''; ?> >Armed Forces Americas</option>
							<option <?php echo $State=='AP'?'selected':''; ?> >Armed Forces Pacific</option>
							<option <?php echo $State=='AE'?'selected':''; ?> >Armed Forces Europe</option>	
						</select></br>
						<span class="error"><?php echo $State_error ?></br></span></br>
						
						<label>Card Type</label></br>
						
						<span class="error"><?php echo $CardType_error; ?></span></br>
						<label class="radiolabel"><input type="radio" name="cardtype" value="Visa" <?php echo ($CardType=='Visa')? 'checked':''; ?> />Visa</label>
						
						<label class="radiolabel"><input type="radio" name="cardtype" value="Mastercard" <?php echo ($CardType=='Mastercard')? 'checked':''; ?> />Mastercard</label>
						
						<label class="radiolabel"><input type="radio" name="cardtype" value="Discover" <?php echo ($CardType=='Discover')? 'checked':''; ?> />Discover</label>
						
						<label class="radiolabel"><input type="radio" name="cardtype" value="American Express" <?php echo ($CardType=='American Express')? 'checked':''; ?> />American Express</label></br></br>


						<label for= "cardnumber">Card Number: </label><br> <input name = "CardNumber" type = "text" value='<?php echo htmlentities($CardNumber) ?>'></br>
						<span class="error"><?php echo $CardNumber_error ?></br></span>
						
						<label for= "expirationdate">Expiration Date: </label><br> <input name = "ExpirationDate" type = "text" value='<?php echo htmlentities($CardExpDate) ?>'></br>
						<span class="error"><?php echo $CardExpDate_error ?></br></span>
						
						<label for= "securitycode">Security Code: </label><br> <input name = "SecurityCode" type = "text" value='<?php echo htmlentities($CardCCV) ?>'></br>
						<span class="error"><?php echo $CardCCV_error ?></br></span>
						
						<input type="submit" name="submit" value="Submit"/>
						
					</fieldset>
				</form>
			<div><span><?php echo $Approval; ?></span></div>
		</main>
	</body>
</html>