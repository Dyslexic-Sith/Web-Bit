<html>
<?php
session_set_cookie_params(0);
session_start();
if ( !ISSET($_SESSION['employee']) || !ISSET($_SESSION['empID']) || $_SESSION['empType'] != "Contractor") {

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
  echo"
<head>
  <link rel='stylesheet' type='text/css' href='BIT.css' />
  <script type='text/javascript' src='BIT.js'></script>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body>";
  $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

  if (ISSET($_POST['selectedJob'])){
    $sql_update_job = "UPDATE JobRequest SET status = 'Marked for Completion' WHERE jobRequestID = ".$_POST['selectedJob'];
    $sql_update_result = mysqli_query($db, $sql_update_job);
    if(mysqli_affected_rows($db) == 0){
      echo     "<div id='snackbar1'>Something went wrong, please try again.</div>
            <script>myFunction1();</script>";
    }
    else if(mysqli_affected_rows($db) != 0){
       echo     "<div id='snackbar'>Job marked for completion!</div>
            <script>myFunction();</script>";
    }
  }

  echo "<div class='wrapper'>
  <div class='header'>
    <img class='col-7' id='banner' src='bitserviceslogo.jpg' />
  </div>
    <ul class='col-12' >
      <li><a href='index.php'>Home</a></li>
      <li><a href='signUp.php'>Sign Up</a></li>
      <li><a href='login.php'>Login</a></li>
      <li><a href='about.php'>About</a></li>
      <li><a href='contact.php'>Contact</a></li>
      <li><a href='contractorHome.php' class='active'>Current Jobs</a></li>
      <li><a href='#' class='active'>".$_SESSION['employee']."</a></li>
      <li><a href='logout.php'>Logout</a></li>
    </ul>
  </div>";
  if ($_SESSION["success"] == 1){

   echo     "<div id='snackbar'>Welcome to the Contractor Portal!</div>
            <script>myFunction();</script>";
    $_SESSION["success"] = 0;
}
$sql = "SELECT jobRequestID, jobDescription, jobEntryDate, jobRequiredDate, jr.status, c.clientFirstName, c.clientLastName, c.clientPhone, cl.clientLocationUnit, cl.clientLocationStreet, cl.clientLocationSuburb, cl.clientLocationPostcode, cl.clientLocationState, cl.clientLocationDetails, s.skillsTitle
FROM JobRequest jr, Client c, ClientLocation cl, Skills s
WHERE jr.contractorID = '".$_SESSION['empID']."'
AND jr.clientID = c.clientID
AND cl.clientID = c.clientID
AND jr.skillsID = s.skillsID
AND jr.clientLocationID = cl.clientLocationID
AND jr.status != 'Completed'
ORDER BY jobRequiredDate";
$result = mysqli_query($db, $sql);

$sql_jobID = "SELECT jobRequestID FROM JobRequest WHERE contractorID = '".$_SESSION['empID']."' AND status != 'Completed' AND status != 'Marked for Completion'";
$jobIDs = mysqli_query($db, $sql_jobID);

echo "<div class='col-12 main' style='overflow-x:auto;'>
      <p style='font-weight:bold; color: #d60000;'> These are your current jobs " .$_SESSION['employee']."</p>";
echo "<table class='col-12'>";
echo "<tr><td class='tableHeader'>Job ID</td><td class='tableHeader'>Job Description</td><td class='tableHeader'>Entry Date</td><td class='tableHeader'>Due Date</td><td class='tableHeader'>Job Status</td><td class='tableHeader'>Client First Name</td><td class='tableHeader'>Client Last Name</td><td class='tableHeader'>Client Phone Number</td><td class='tableHeader'>Address Unit/Suite</td><td class='tableHeader'>Street Address</td><td class='tableHeader'>Suburb</td><td class='tableHeader'>Postcode</td><td class='tableHeader'>State</td><td class='tableHeader'>Address Details</td><td class='tableHeader'>Skill Needed</td></tr>";
while($row = mysqli_fetch_array($result))
{
	echo"<tr><td>".$row["jobRequestID"]."</td><td>".$row["jobDescription"]."</td><td>".$row["jobEntryDate"]."</td><td>".$row["jobRequiredDate"]."</td><td>".$row["status"]."</td><td>".$row["clientFirstName"]."</td><td>".$row["clientLastName"]."</td><td>".$row["clientPhone"]."</td><td>".$row["clientLocationUnit"]."</td><td>".$row["clientLocationStreet"]."</td><td>".$row["clientLocationSuburb"]."</td><td>".$row["clientLocationPostcode"]."</td><td>".$row["clientLocationState"]."</td><td>".$row["clientLocationDetails"]."</td><td>".$row["skillsTitle"]."</td></tr>";

}
echo "</table>";

echo "<br>";
echo "<form name='jobComplete' method='post' action='contractorHome.php'>
      <p style='color:#163b58;'>Please note these selections are shown by their Job ID, found in the first column in the above table.</p><br>
      <label for='selectedJob'>Push a job to be marked as Completed</label>
      <select name='selectedJob'>";
      while($arow = mysqli_fetch_array($jobIDs)){
        echo "<option value=".$arow['jobRequestID'].">".$arow['jobRequestID']."</option>";
      }
echo "</select>
      <br>
      <input type='submit' value='Complete' name='completeJob' style='width:20%; margin-left:auto;margin-right:auto;'>
      </form
      <br>
      <br>";
echo "</div>
    <br>

<footer class='col-12'>Created by Sam Coianiz 2017 &copy;</footer>
</body>";}
    ?>
</html>
