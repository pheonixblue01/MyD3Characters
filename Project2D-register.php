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
<body style="background-color:black; font-color:#A8A8A8;">
<div class="row">
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	<a href="./index.html"> Home </a>				</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	<a href="./Project2A.html"> Part A </a>			</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	<a href="./Project2B-1.html"> Part B </a>		</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	<a href="./Project2C.html"> Part C </a>			</div>
</div>
<div class="page-header" align="center" style="padding-top:0px; padding-bottom:0px">
	<style> .logoholder{ width:1050px; height:135px;}
	</style>
	<div class="logoholder">
	<img src="./Images/Header-Left.png" style="float:left">
	<img src="./Images/RegisterLogo.png"  style="float:left">
	<img src="./Images/Header-Right.png"  style="float:left"></div>
</div>
<div class"row">
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	</div>
	<style> .nav-pills  li.active a, .nav-pills li.active a:hover {background-color:#000000; vertical-align:middle;}
			.nav-pills li.doubleListItem a, .nav-pills li.doubleListItem a:hover {padding-top:0pt; padding-bottom: 0pt;}
	</style>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<ul class="nav nav-pills nav-justified">
			<li role="presentation">				<a href="./Project2D.html">Home</a>						</li>
			<li role="presentation">				<a href="./Project2D-MyAccount.html">Account</a>		</li>
			<li role="presentation">				<a href="./Project2D-MyCharacters.html">Characters</a>	</li>
			<li role="presentation">				<a href="./Project2D-Classes.html">Classes</a>			</li>
			<li role="presentation">				<a href="./Project2D-Help_Home.html">Support </a>		</li>	
			<li role="presentation">				<a href="./Project2D-Login.html">Login</a>				</li>
			<li role="presentation" class="active">	<a href="./Project2D-Register.html">Register</a>		</li>
		</ul>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">	</div>
</div>
	<br><br><hr>
<div class="row">	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <!-- empty row to create space --></div>	</div>
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

</body>

</html>
