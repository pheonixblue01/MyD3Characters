<?php
	include('dbconfig.inc');
		$counter = 0;
		$con = mysql_connect($hostname, $username, $password);
	if(!$con)
	{
		$error_message="Unable to connect to database! Please try again later. Error Message: " .mysql_error();
	}
		mysql_select_db($dbname);

?>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Account Registration </title>
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/custom.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>

</head>
<body>
<div class="page-header">
	<h1 style="text-align:center;">	My D3 Characters</h1>
</div>

<div class="container">
	<div class"row">
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	</div>
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	
				<p>	<a href="./Project2C-Login.html">Login</a>	</p>	
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<ul class="nav nav-tabs">
					<li role="presentation"><a href="./Project2C.html">Home</a></li>
					<li role="presentation"><a href="./Project2C-MyAccount.html">My Account</a></li>
					<li role="presentation"><a href="./Project2C-MyCharacters.html">My Characters</a></li>
					<li role="presentation"><a href="./Project2C-GearSets.html">Gear Sets</a></li>
					<li role="presentation"><a href="./Project2C-Classes.html">Class Overview</a></li>
					<li role="presentation"><a href="./Project2C-Forum.html">Forum</a></li>
					<li role="presentation"><a href="./Project2C-AboutUs.html">About Us</a></li>
				</ul>
			</div>
	</div>

<?php
	$username = $_POST['username'];
	$password = $_POST['user_password'];
	$email = $_POST['user_email'];
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$hashed_pass = sha1($password);

	$query = 	
				"INSERT INTO AccountInfo (userAccountName, userPassWord, userEmail, userFirstName, userLastName)
				 VALUES('$username', '$hashed_pass', '$email', '$firstname', '$lastname');"; 

	$duplicateQuery = "SELECT COUNT(userAccountName) as account_count FROM AccountInfo WHERE userAccountName = '$username' ";
	$query = trim($query);
	$duplicateQuery = trim($duplicateQuery);
	$duplicateRun = mysql_query($duplicateQuery);
	$duplicateResult = mysql_fetch_row($duplicateRun);


	$result = mysql_query ($duplicateQuery);

	if ($result == false)
		{
			echo mysql_error();
		}
	else{
		while($row=mysql_fetch_object($result))	
			{
				$counter = $row->account_count;
			}
		}

	if ($counter < 1)
		{
			$result = mysql_query($query);
			if ($result == false)
				{
					$error_message = 
					'<HTML><HEAD>	</HEAD><BODY>'
				.	'	<h2>An error has occured.</h2>'
				.	'	<br />'
				.	'	<p>'
				.	' 	We apologize for the inonvenience. The following error deatils are available:'
				.	' 	<br />'
				.	'	'. mysql_error()
				.	'	<br />'
				.	'	' . $query
				.	'	</p>'
				.	'	<br>'
				.	'</BODY></HTML>'
				;
				echo $error_message;
				}
		}

?>
</div>

</body>

</html>
