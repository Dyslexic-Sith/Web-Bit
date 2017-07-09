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
          <li><a href='clientHome.php'>Current Jobs</a></li>
          <li><a href='clientRequestJob.php'>Request New Job</a></li>
          <li><a href='clientPreviousJobs.php' class='active'>Previous Jobs</a></li>
          <li><a href='#' class='active'>".$_SESSION['client']."</a></li>
          <li><a href='logout.php'>Logout</a></li>
	      </ul>
</div>";
$sql = "SELECT jobRequiredDate, jobCompletedDate, jobDescription, JobRequest.status, employeeFirstName, clientLocationStreet
FROM ClientLocation, JobRequest
LEFT JOIN Employee
ON JobRequest.contractorID = employeeID
WHERE JobRequest.clientLocationID = ClientLocation.clientLocationID
AND JobRequest.status = 'Completed'
AND JobRequest.clientID = '".$_SESSION['clientID']."'
ORDER BY jobCompletedDate DESC";
$result = mysqli_query($db, $sql);


	echo "<div class='col-8 main' style='overflow-x:auto;'>
		<p style='font-weight:bold; color: #d60000;'> These are your completed jobs " .$_SESSION['client']."</p>";

  echo "<table class='col-8' style='margin-left:auto; margin-right:auto;'>";
  echo "<tr><td class='tableHeader'>Date Due</td>
        <td class='tableHeader'>Date Completed</td>
        <td class='tableHeader'>Job Location</td>
        <td class='tableHeader'>Contractor Name</td>
        <td class='tableHeader'>Job Description</td>
        <td class='tableHeader'>Job Status</td></tr>";
while($row = mysqli_fetch_array($result)){
  echo"<tr><td>".$row["jobRequiredDate"]."</td>
        <td>".$row["jobCompletedDate"]."</td>
        <td>".$row["clientLocationStreet"]."</td>
        <td>".$row["employeeFirstName"]."</td>
        <td>".$row["jobDescription"]."</td>
        <td>".$row["status"]."</td></tr>";
}
  echo "</table>

  </div>

	<footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
</body>";}
        ?>
</html>
