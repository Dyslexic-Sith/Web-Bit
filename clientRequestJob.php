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
    <li><a href='clientRequestJob.php' class='active'>Request New Job</a></li>
    <li><a href='clientPreviousJobs.php'>Previous Jobs</a></li>
        <li><a href='#' class='active'>".$_SESSION['client']."</a></li>
        <li><a href='logout.php'>Logout</a></li>
	</ul>
</div>";
$sql_location_select = "SELECT clientLocationID, clientLocationUnit, clientLocationStreet, clientLocationSuburb FROM ClientLocation WHERE clientID = '".$_SESSION['clientID']."'";
$location_result = mysqli_query($db, $sql_location_select);

$sql_skill_select = "SELECT skillsID, skillsTitle FROM Skills WHERE status = '1'";
$skills_result = mysqli_query($db, $sql_skill_select);
echo "
<div class='col-9 main'>

<p style='color:#d60000;'>Please fill out this form to request a new job. One of our coordinators will get back to you to confirm within 24 hours.</p>

<form class='jobRequest' action='addJobRequest.php' method='post'>
<label for='location'>Please select the location: </label>
<select name='location'>";
while ($arow = mysqli_fetch_array($location_result)){
	echo "<option value =".$arow['clientLocationID'].">".$arow['clientLocationSuburb']."</option>";

}
echo "
</select>
<br>
<br>
<label for='skills'>Please choose the skill that most closely describes the job: </label>
<select name='skills'>";
while ($arow = mysqli_fetch_array($skills_result)){
	echo "<option value =".$arow['skillsID'].">".$arow['skillsTitle']."</option>";

}
echo "</select>
<br>
<br>
<label for='dueDate'>When would you like the job done? </label>
<input type='date' name='dueDate' />
<br>
<br>
<label for='jobDescription'>Tell us a little about the job:</label>
<textarea name='jobDescription'> </textarea>
<input type='submit' style='width:20%; margin-left:auto;margin-right:auto;'/>
</form>

	</div>
  <footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
</body>";}
        ?>
</html>
