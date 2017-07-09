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
  $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);


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
    $sql_select_job = "SELECT * from JobRequest where jobRequestID =".$_POST['jobs'];
    $job_result = mysqli_query($db, $sql_select_job);
    $job_array = mysqli_fetch_array($job_result);
    $selected_jobID = $_POST['jobs'];

    $clientID = $job_array['clientID'];
    $clientLocationID = $job_array['clientLocationID'];

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

    $sql_skill = "SELECT skillsTitle FROM Skills WHERE skillsID = ".$job_array['skillsID'];
    $skill_result = mysqli_query($db, $sql_skill);
    $skill_array = mysqli_fetch_array($skill_result);
    $skill_title = $skill_array['skillsTitle'];

  echo "<div class='col-10 main' style='overflow-x:auto;'>
        <p style='font-weight:bold; color: #d60000;'> You are looking for a contractor with the skill of ".$skill_title.".</p>
        <p style='font-weight:bold; color: #d60000;'> To do the job of :".$job_array['jobDescription'].".</p>
        <p style='font-weight:bold; color: #d60000;'> The location of the job is: ".$location_street.", ".$location_suburb.".</p>
        <p style='font-weight:bold; color:#d60000;'> These are the contractors that can do the job: </p>";


        $sql_select_skills = "SELECT employeeFirstName, employeeLastName, Contractor.contractorID FROM Employee, ContractorSkills, Contractor WHERE ContractorSkills.skillsID = ".$job_array['skillsID']." AND ContractorSkills.contractorID = Contractor.contractorID AND Contractor.contractorID = employeeID";
        $contractor_result = mysqli_query($db, $sql_select_skills);
      /*  $contractor_array = mysqli_fetch_array($contractor_result);*/

        echo "<form name='jobAssign' method='post' action='adminAssignJobs.php'>
              <select name='contractor' size='12'>";
              while($row = mysqli_fetch_array($contractor_result)){
                echo"<option value=".$row['contractorID'].">".$row['employeeFirstName']." ".$row['employeeLastName']."</option>";
              }
        echo "</select>";
        echo "<input type='hidden' value=".$selected_jobID." name='selected_job'>";
        echo "<input type='submit' value='Assign Job to Contractor' name='assignJob' style='width:40%; margin-left:auto;margin-right:auto;'>";
        echo "</form>";
        echo "
        <p style='font-weight:bold;'>Hitting the above button will take you to a page where you can view the contractors who possess the skills needed for the selected job.</p>";


        echo "</div>
              <footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
        </body>";
  }


  ?>
</html>
