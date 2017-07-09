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
<div class="col-12 main">
<table>
    <tr>
        <td class="col-5" style="border:none;">
            <div><img class="stock" src="client.jpg"/><a class="col-4 loginButtonLeft" href="loginClient.php" style="margin-top:5px;">Client Login</a></div>
            </td>
        <td class="col-5" style="border:none;">
            <div><img class="stockBig" src="employee.jpg" style="margin-left: 50px;"/><a class="col-5 loginButtonRight" href="loginContractor.php" style="margin-top:5px;">Employee Login</a></div>
            </td>
        </tr>
    </table>
</div>

<footer class="col-12">Created by Sam Coianiz 2017 &copy;</footer>
</body>
</html>
