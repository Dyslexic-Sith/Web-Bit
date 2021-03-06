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
        <ul class='col-12'>
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
   echo "<head>
    <link rel='stylesheet' type='text/css' href='BIT.css' />
    <script type='text/javascript' src='BIT.js'></script>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  </head>
  <body>";
  $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

  if (ISSET($_POST['contractor'])){
    echo "<div id='snackbar'>Job assigned successfully</div><script>myFunction();</script>";
    $sql_update_job = "UPDATE JobRequest SET contractorID = ".$_POST['contractor'].", status = 'Assigned' WHERE jobRequestID = ".$_POST['selected_job'];
    $sql_update_result = mysqli_query($db, $sql_update_job);
    if(mysqli_affected_rows($db) == 0){
      echo "<div id='snackbar1'>Job not assigned, please try again</div><script>myFunction1()</script>";
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
        <li><a href='adminHome.php' >Mark Jobs as Completed</a></li>
        <li><a href='adminAssignJobs.php'class='active'>Assign Jobs to Contractors</a></li>
        <li><a href='#' class='active'>".$_SESSION['employee']."</a></li>
        <li><a href='logout.php'>Logout</a></li>
      </ul>
    </div>";
  echo "<div class='col-10 main' style='overflow-x:auto;'>
        <p style='font-weight:bold; color: #d60000;'> This screen allows you to assign a job request from a client to a contractor with the relevant skillset. Please select the job request from the list below then press the 'Find Contractors' button.</p>";

        $sql_select_jobs = "SELECT * from JobRequest where contractorID is null and status = 'Submitted'";
        $job_result = mysqli_query($db, $sql_select_jobs);


        echo "<form name='jobAssign' method='post' action='adminAssignContractor.php'>
              <select name='jobs' size='12'>";
        while($row = mysqli_fetch_array($job_result)){
          $clientID = $row['clientID'];
          $clientLocationID = $row['clientLocationID'];

          $sql_client_name = "SELECT clientFirstName, clientLastName FROM Client WHERE clientID = ".$clientID;
          $client_result = mysqli_query($db, $sql_client_name);
          $client_array = mysqli_fetch_array($client_result);
          $client_fname = $client_array['clientFirstName'];
          $client_lname = $client_array['clientLastName'];

          $sql_client_location = "SELECT clientLocationStreet, clientLocationSuburb FROM ClientLocation WHERE clientLocationID = ".$clientLocationID;
          $location_result = mysqli_query($db, $sql_client_location);
          $location_array = mysqli_fetch_array($location_result);
          $location_street = $location_array['clientLocationStreet'];
          $location_suburb = $location_array['clientLocationSuburb'];

          $sql_skill = "SELECT skillsTitle FROM Skills WHERE skillsID = ".$row['skillsID'];
          $skill_result = mysqli_query($db, $sql_skill);
          $skill_array = mysqli_fetch_array($skill_result);
          $skill_title = $skill_array['skillsTitle'];
        echo"<option value = ".$row['jobRequestID'].">".$client_fname." ".$client_lname.", ".$location_street.", ".$location_suburb.", ".$skill_title."</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Find Contractors' name='findContractors' style='width:40%; margin-left:auto;margin-right:auto;'>";
        echo "</form>";
        echo "
        <p style='font-weight:bold;'>Hitting the above button will take you to a page where you can view the contractors who possess the skills needed for the selected job.</p>";


        echo "</div>
              <footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
        </body>";
  }


  ?>
</html>
