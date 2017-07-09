<html>
<head>
<link rel="stylesheet" type="text/css" href="BIT.css" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="BIT.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="header">
        <img class="col-7" id="banner" src="bitserviceslogo.jpg" />
    </div>
        <ul class="col-12" >
		<li><a href="index.php">Home</a></li>
		<li><a href="signUp.php">Sign Up</a></li>
		<li><a href="login.php" class="active">Login</a></li>
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
<div class="col-8 main">
<h1 class="col-12" style="color:#163b58">Login with your Client Username and Password</h1>
<form name="clientLogin" method="post" onsubmit="validateClientLogin()" action="clientLogin.php">
<label for="username">Username: </label>
<input type="text" name="username" required />

<label for="password">Password:  </label>
<input type="password" name="password" required />
<br>
<br>

<input type="submit" name="submit" value="login"/>
</form>
</div>
<footer class="col-12">Created by Sam Coianiz 2017 &copy;</footer>
</body>
</html>
