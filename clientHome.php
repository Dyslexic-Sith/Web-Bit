<html>
    <?php
    session_set_cookie_params(0);
    session_start();
    if ( !ISSET($_SESSION['client'])) {

	header('Refresh: 5, URL=login.php');
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
  		<h1 style='color:#d60000;'>Access to this page is restricted. We are redirecting you to the login page.</h1>
  	</div>

  	<footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
  </body>";
	die();
}
else{
  $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

    echo"
<head>
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
		        <li><a href='index.php'>Home</a></li>
		        <li><a href='signUp.php'>Sign Up</a></li>
		        <li><a href='login.php'>Login</a></li>
		        <li><a href='about.php'>About</a></li>
		        <li><a href='contact.php'>Contact</a></li>
                <li><a href='clientHome.php' class='active'>Current Jobs</a></li>
                <li><a href='clientRequestJob.php'>Request New Job</a></li>
                <li><a href='clientPreviousJobs.php'>Previous Jobs</a></li>
                <li><a href='#' class='active'>".$_SESSION['client']."</a></li>
                <li><a href='logout.php'>Logout</a></li>
	        </ul>


        </div>";
if ($_SESSION["success"] == 1){

   echo     "<div id='snackbar'>Welcome to the Client Portal!</div>
            <script>myFunction();</script>";
    $_SESSION["success"] = 0;
}

$sql = "SELECT jobRequiredDate, jobDescription, JobRequest.status, employeeFirstName, clientLocationStreet
from ClientLocation, JobRequest
left join Employee
on JobRequest.contractorID = employeeID
where JobRequest.clientLocationID = ClientLocation.clientLocationID
and JobRequest.status != 'Completed'
and JobRequest.clientID = '".$_SESSION['clientID']."'";
$result = mysqli_query($db, $sql);


	echo "<div class='col-8 main'>

		<p style='font-weight:bold; color: #d60000;'> These are your current jobs " .$_SESSION['client']."</p>";

  echo "<table class='col-8' style='margin-left:auto; margin-right:auto;'>";
  echo "<tr><td class='tableHeader'>Date Due</td>
        <td class='tableHeader'>Job Location</td>
        <td class='tableHeader'>Contractor Name</td>
        <td class='tableHeader'>Job Description</td>
        <td class='tableHeader'>Job Status</td></tr>";
while($row = mysqli_fetch_array($result)){
  echo"<tr><td>".$row["jobRequiredDate"]."</td>
        <td>".$row["clientLocationStreet"]."</td>
        <td>".$row["employeeFirstName"]."</td>
        <td>".$row["jobDescription"]."</td>
        <td>".$row["status"]."</td></tr>";
}
  echo "</table>
  <p>If the job has the status of 'Submitted' then we are reviewing our contractors to see who is best suited for the job. It will be given the status of 'Assigned' when we find the perfect one!</p>
  </div>

	<footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
</body>";}
        ?>
</html>
