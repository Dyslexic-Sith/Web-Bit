<html>
<head>
<link rel="stylesheet" type="text/css" href="BIT.css" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="wrapper">
    <div class="header">
        <img class="col-7" id="banner" src="bitserviceslogo.jpg" />
    </div>
        <ul class="col-12" >
		<li><a href="index.php" class="active">Home</a></li>
		<li><a href="signUp.php">Sign Up</a></li>
		<li><a href="login.php">Login</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="contact.php">Contact</a></li>
    <?php
    session_set_cookie_params(0);
    session_start();
      if (ISSET($_SESSION['client']))
        echo "<li><a href='clientHome.php'>Current Jobs</a></li>
              <li><a href='clientRequestJob.php'>Request New Job</a></li>
              <li><a href='clientPreviousJobs.php'>Previous Jobs</a></li>
              <li><a href='#' class='active'>".$_SESSION['client']."</a></li>
              <li><a href='logout.php'>Logout</a></li>";
          else if (ISSET($_SESSION['employee']) && $_SESSION['empType'] != "Admin")
          echo "<li><a href='contractorHome.php'>Current Jobs</a></li>
                <li><a href='#' class='active'>".$_SESSION['employee']."</a></li>
                <li><a href='logout.php'>Logout</a></li>";
                else if (ISSET($_SESSION['employee']) && $_SESSION['empType'] = "Admin")
                  echo "<li><a href='adminHome.php'>Mark Jobs as Completed</a></li>
                        <li><a href='adminAssignJobs.php'>Assign Jobs to Contractors</a></li>
                        <li><a href='#' class='active'>".$_SESSION['employee']."</a></li>
                        <li><a href='logout.php'>Logout</a></li>";
     ?>
	</ul>
</div>



	<div class="col-9 main">
		<h1>We are BIT Field Support Services</h1>
        <h2>A subdivision of Business Information Technology Services</h2>
        <p class="col-12" style="text-align:center;font-weight:bold;color:#163b58">We are here to help your business do business.</p>
        <img src="business.jpg" class="col-8" />
        <p>With over 100 contractors all around Australia, with an impressive list of skills, <br>we are sure to have someone who can do the job you need.
          <br>We'll get the job done when you need by someone qualified in that specific skill.</p>
        <p class="col-12">If you are already a client then please log in to see the status of your current jobs, or request a new one.</p>
        <img src="businessstrategy.jpg" class="col-8" />
        <p>If you would like to become a client then please sign up with a few details and one of our Coordinators will be in touch shortly.</p>
	</div>

	<footer class="col-9">Created by Sam Coianiz 2017 &copy;</footer>
</body>
</html>
