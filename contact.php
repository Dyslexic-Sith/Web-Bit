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
		<li><a href="login.php">Login</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="contact.php" class="active">Contact</a></li>
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
<h2 style="color:#d60000;">Enter your details and your message here and we'll get straight back to you.</h2>
<form name="contactForm" method="post" action="#">
<label for="name">Contact Name<span style="color:red">*</span></label>
<input type="text" name="name" placeholder="Your name here..." required>
<label for="phone">Contact Phone Number</label>
<input type="text" name="phone" placeholder="Your phone number here...">
<label for="email">Contact Email<span style="color:red">*</span></label>
<input type="email" name="email" placeholder="Your email here..." required>
<label for="message">Your enquiry or message here<span style="color:red">*</span></label>
<textarea name="message" placeholder="Put your message here..."></textarea>
<label for="submitContact" name="required">Required fields are marked with an <span style="color:red">*</span></label>
<input type="submit" value="Send Message" name="submitContact">
</form>
</div>
<footer class="col-8">Copyright &copy; 2017 Copyright Holder All Rights Reserved.</footer>
</body>
</html>
