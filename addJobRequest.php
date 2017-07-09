<html>
<?php
session_set_cookie_params(0);
session_start();
$db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

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
	$clientID = $_SESSION['clientID'];
	$skillID = $_POST['skills'];
  $locationID = $_POST['location'];
  $description = mysqli_real_escape_string($db, $_POST['jobDescription']);
  $date = $_POST['dueDate'];

	$sql_insert_job = "INSERT INTO JobRequest(clientID, clientLocationID, skillsID, jobDescription, jobEntryDate, jobRequiredDate, status) VALUES('".$clientID."', '".$locationID."', '".$skillID."', '".$description."', CURDATE(), '".$date."', 'Submitted')";

	$result = mysqli_query($db, $sql_insert_job);

  if (!$result){
    echo "Error: <br>". mysqli_error($db);
    header('Refresh:3, URL=clientRequestJob.php');
  }else{
    if(mysqli_affected_rows($db) != 0){
      header('Refresh:3, URL=clientRequestJob.php');
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
        <h1 style='color:#d60000;'>Job has been added successfully. Taking you back to the job request page.</h1>
      </div>

      <footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
      </body>";
    }
  }
}

?>

</html>
