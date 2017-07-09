<html>
<?php
session_set_cookie_params(0);
session_start();
if ( !ISSET($_SESSION['employee']) || !ISSET($_SESSION['empID']) || $_SESSION["empType"] != "Admin") {

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

  if ($_POST['selectedJob'] != null){
    $sql_update_job = "UPDATE JobRequest SET status = 'Completed' WHERE jobRequestID = ".$_POST['selectedJob'];
    $sql_update_result = mysqli_query($db, $sql_update_job);
    if(mysqli_affected_rows($db) == 0){
      echo 'alert("We could not update this job. Please try again.")';
    }
  }
echo"
<head>
  <link rel='stylesheet' type='text/css' href='BIT.css' />
  <script type='text/javascript' src='BIT.js'></script>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body onload='javascript:myFunction()'>

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
      <li><a href='adminHome.php' class='active'>Mark Jobs as Completed</a></li>
      <li><a href='adminAssignJobs.php'>Assign Jobs to Contractors</a></li>
      <li><a href='#' class='active'>".$_SESSION['employee']."</a></li>
      <li><a href='logout.php'>Logout</a></li>
    </ul>
  </div>";
if ($_SESSION["success"] == 1){

   echo     "<div id='snackbar'>Welcome to the Administrator Portal!</div>
            <script>myFunction();</script>";
    $_SESSION["success"] = 0;
}
$sql = "SELECT jobRequestID, jobRequiredDate, jobDescription, JobRequest.status, employeeFirstName, clientLocationStreet
FROM ClientLocation, JobRequest
LEFT JOIN Employee
ON JobRequest.ContractorID = employeeID
WHERE JobRequest.clientLocationID = ClientLocation.clientLocationID
AND JobRequest.status = 'Marked for Completion'";
$result = mysqli_query($db, $sql);

$sql_jobID = "SELECT jobRequestID FROM JobRequest WHERE status = 'Marked for Completion'";
$jobIDs = mysqli_query($db, $sql_jobID);
if(mysqli_affected_rows($db) != 0){
       echo     "<div id='snackbar'>Job marked as complete!</div>
            <script>myFunction();</script>";
    }
echo "<div class='col-8 main' style='overflow-x:auto;'>
      <p style='font-weight:bold; color: #d60000;'> These jobs have been marked for completion by the completing contractor. Please review and mark as completed so the contractor can be paid for their work.</p>";
      echo "<table class='col-8' style='margin-left:auto; margin-right:auto;'>";
      echo "<tr><td class='tableHeader'>Job ID</td>
            <td class='tableHeader'>Date Due</td>
            <td class='tableHeader'>Job Location</td>
            <td class='tableHeader'>Contractor Name</td>
            <td class='tableHeader'>Job Description</td>
            <td class='tableHeader'>Job Status</td></tr>";
      while($row = mysqli_fetch_array($result)){
      echo"<tr><td>".$row["jobRequestID"]."</td>
            <td>".$row["jobRequiredDate"]."</td>
            <td>".$row["clientLocationStreet"]."</td>
            <td>".$row["employeeFirstName"]."</td>
            <td>".$row["jobDescription"]."</td>
            <td>".$row["status"]."</td></tr>";
      }
      echo "</table>
      <p style='font-weight:bold;'>Marking jobs as completed here will change the job status in our database. It will flag the job as completed and will be sent to payroll to pay the contractor for their work. Please make sure that the job you selected is the correct one.</p>";

      echo "<form name='jobComplete' method='post' action='adminHome.php'>
            <p style='color:#d60000;'>Please note these selections are shown by their Job ID, found in the first column in the above table.</p>
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
            <br>
            </div>
            <footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
      </body>";}
    ?>
</html>
