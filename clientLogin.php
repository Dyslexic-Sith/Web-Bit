<html>
<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
  $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

	if (session_start())
	session_destroy();
	$sql_select = "SELECT Client.clientID AS id, clientUsername, clientPassword, clientFirstName, clientLastName FROM ClientLogin, Client
	where clientUsername ='".$username."' AND clientPassword ='".$password."' AND Client.clientID = ClientLogin.clientID";
	$result = mysqli_query($db, $sql_select);
	header('Refresh:3, URL=loginClient.php');
	if (mysqli_num_rows($result) == 0){
		echo "<head>
		<link rel='stylesheet' type='text/css' href='BIT.css' />
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		</head>
		<body>
				<div class='wrapper'>
				<div class='header'>
						<img class='col-7' id='banner' src='bitserviceslogo.jpg' />
				</div>
						<ul class='col-12' >
				<li><a href='#'>Home</a></li>
				<li><a href='#'>Sign Up</a></li>
				<li><a href='#'>Login</a></li>
				<li><a href='#'>About</a></li>
				<li><a href='#'>Contact</a></li>
			</ul>
		</div>



			<div class='col-8 main'>
				<h1 style='color:#d60000;'>Username and password do not match our records. Please check your details and try again.</h1>
			</div>

			<footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
		</body>";
	}
	 else if(!isset($username) || !isset($password)){
		echo "Username or password empty";
	}else{

			if(mysqli_num_rows($result) != 0){
			$row = mysqli_fetch_array($result);
			session_set_cookie_params(0);
			session_start();
			$_SESSION["client"] = $row["clientFirstName"];
			$_SESSION["clientID"] = $row["id"];
			$_SESSION["success"] = 1;
            echo 'alert($_SESSION["client"])';
            header('Location: clientHome.php');

	}
    }

 ?>
 </html>
