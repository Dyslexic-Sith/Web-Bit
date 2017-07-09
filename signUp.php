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
		<li><a href="signUp.php" class="active">Sign Up</a></li>
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
<div class="col-8 clientLogin">
<h1 style="margin-top:50px">Register as a BIT Services client</h1>
<form class="regForm" name="regForm" onsubmit="return validateForm()" method="post" action="addClient.php">
        <label for="bname">Business Name </label>
        <input type="text" name="bname" placeholder="Business name..." >
		<label for="fname">Contact First Name <span style="color:red">*</span></label>
        <input type="text" name="fname" placeholder="Your name..." required>
        <label for="lname">Contact Last Name <span style="color:red">*</span></label>
        <input type="text" name="lname" placeholder="Last name..." required>
        <label for="phone">Contact Phone <span style="color:red">*</span></label>
        <input type="text" name="phone" name="phone" placeholder="Mobile or landline..." required>
        <label for="email">Contact Email</label>
        <input type="email" name="email" placeholder="example@webdomain.com">
		<label for="fax">Contact Fax </label>
        <input type="text" name="fax" name="phone" placeholder="Fax number..." >
		<label for="unit">Unit/Suite Number</label>
        <input type="text" name="unit" placeholder="Unit/suite number..." >
		<label for="address">Street Address <span style="color:red">*</span></label>
        <input type="text" name="address" placeholder="Address..." required>
		<label for="suburb">Suburb<span style="color:red">*</span></label>
        <input type="text" name="suburb" placeholder="Suburb..." required>
        <label for="postcode">Postcode <span style="color:red">*</span></label>
        <input type="text" name="postcode" placeholder="2000" maxlength="4" required>
		<label for="state">State<span style="color:red">*</span></label>
        <input type="text" name="state" placeholder="State..." required>
		<label for="notes">Address Details</label>
        <textarea name="notes" placeholder="Anything that will affect our ability to find or access the property/building..."></textarea>
        <label for="username">Username <span style="color:red">*</span></label>
        <input type="text" name="username" name="username" required>
        <label for="password">Password <span style="color:red">*</span></label>
        <input type="password" name="password" id="password" required>
        <label for="submitReg" name="required">Required fields are marked with an <span style="color:red">*</span></label>
        <input type="submit" value="Submit" name="submitReg">
        </form>

</div>
<footer class="col-8">Created by Sam Coianiz 2017 &copy;</footer>
</body>
</html>
