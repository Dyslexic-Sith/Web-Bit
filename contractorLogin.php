<html>
<?php

	$username = $_POST['username'];
	$password = $_POST['password'];
	$db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

	if (session_start())
	session_destroy();
	$sql_select1 = "SELECT username, loginPassword, employeeFirstName, Login.employeeID FROM Login, Employee
	WHERE username ='".$username."' and loginPassword ='".$password."' and Employee.employeeID = Login.employeeID";

	$result1 = mysqli_query($db, $sql_select1);
	if (mysqli_num_rows($result1) == 0){
		echo "<head>
	  <link rel='stylesheet' type='text/css' href='BIT.css' />
		<script type='text/javascript' src='BIT.js'></script>
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
		header('Refresh:3, URL=loginContractor.php');
	}
	if(!isset($username) || !isset($password)){
		echo "window.alert('Username or password empty')";
		header('Refresh:3, URL=loginContractor.php');
	}else{
		// database code goes here
		if(mysqli_num_rows($result1) != 0){
			$row = mysqli_fetch_array($result1);
			session_set_cookie_params(0);
			session_start();

			$_SESSION["employee"] = $row["employeeFirstName"];
			$_SESSION["empID"] = $row["employeeID"];

			$contractor_select = "SELECT * FROM Contractor WHERE contractorID =".$_SESSION["empID"];
			$contractorID = mysqli_query($db, $contractor_select);
			if(mysqli_num_rows($contractorID) != 0){
				$_SESSION["empType"] = "Contractor";
				$_SESSION["success"] = 1;
				header('Location: contractorHome.php');

			}
			else {
				$_SESSION["empType"] = "Admin";
				$_SESSION["success"] = 1;
				header('Location: adminHome.php');
			}
				};

	}

?>
</html>
