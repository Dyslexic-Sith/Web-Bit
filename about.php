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
		<li><a href="index.php">index</a></li>
		<li><a href="signUp.php">Sign Up</a></li>
		<li><a href="login.php">Login</a></li>
		<li><a href="about.php" class="active">About</a></li>
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
  <h2 class="col-5" style="color:#d60000;">How We Started</h2>
<div class="col-12 about1">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat blandit lectus eget sodales. Phasellus in dolor eget sem eleifend congue. Aenean sit amet ipsum eleifend, hendrerit sapien at, rutrum nisl. Ut diam sem, maximus eget enim faucibus, vestibulum laoreet orci. Etiam cursus vehicula odio, eget ullamcorper sapien finibus quis. Sed eget nibh eu diam convallis molestie. Vestibulum ac arcu laoreet, ultricies lorem eu, lacinia nisl. Proin ultricies commodo pretium. Sed quis luctus risus, quis sagittis tellus. Morbi porta massa tellus, eu porta ex pulvinar id. Quisque ut neque elit. Pellentesque commodo, turpis eget gravida commodo, odio nisi facilisis diam, sed tincidunt leo ipsum volutpat tellus.
</div>

<div class="col-9"></div>
<div class="col-5" style="color:#d60000;">
<h2>What We Do</h2>
</div>

<div class="col-12 about2">
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat blandit lectus eget sodales. Phasellus in dolor eget sem eleifend congue. Aenean sit amet ipsum eleifend, hendrerit sapien at, rutrum nisl. Ut diam sem, maximus eget enim faucibus, vestibulum laoreet orci. Etiam cursus vehicula odio, eget ullamcorper sapien finibus quis. Sed eget nibh eu diam convallis molestie. Vestibulum ac arcu laoreet, ultricies lorem eu, lacinia nisl. Proin ultricies commodo pretium. Sed quis luctus risus, quis sagittis tellus. Morbi porta massa tellus, eu porta ex pulvinar id. Quisque ut neque elit. Pellentesque commodo, turpis eget gravida commodo, odio nisi facilisis diam, sed tincidunt leo ipsum volutpat tellus.
</div>
<div class="col-5" style="color:#d60000;">
<h2>How We Can Help You</h2>
</div>

<div class="col-12 about1">
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat blandit lectus eget sodales. Phasellus in dolor eget sem eleifend congue. Aenean sit amet ipsum eleifend, hendrerit sapien at, rutrum nisl. Ut diam sem, maximus eget enim faucibus, vestibulum laoreet orci. Etiam cursus vehicula odio, eget ullamcorper sapien finibus quis. Sed eget nibh eu diam convallis molestie. Vestibulum ac arcu laoreet, ultricies lorem eu, lacinia nisl. Proin ultricies commodo pretium. Sed quis luctus risus, quis sagittis tellus. Morbi porta massa tellus, eu porta ex pulvinar id. Quisque ut neque elit. Pellentesque commodo, turpis eget gravida commodo, odio nisi facilisis diam, sed tincidunt leo ipsum volutpat tellus.
  <br>
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat blandit lectus eget sodales. Phasellus in dolor eget sem eleifend congue. Aenean sit amet ipsum eleifend, hendrerit sapien at, rutrum nisl. Ut diam sem, maximus eget enim faucibus, vestibulum laoreet orci. Etiam cursus vehicula odio, eget ullamcorper sapien finibus quis. Sed eget nibh eu diam convallis molestie. Vestibulum ac arcu laoreet, ultricies lorem eu, lacinia nisl. Proin ultricies commodo pretium. Sed quis luctus risus, quis sagittis tellus. Morbi porta massa tellus, eu porta ex pulvinar id. Quisque ut neque elit. Pellentesque commodo, turpis eget gravida commodo, odio nisi facilisis diam, sed tincidunt leo ipsum volutpat tellus.
</div>
<div class="col-5" style="color:#d60000;">
<h2>One More Paragraph To Make it Look Nice</h2>
</div>

<div class="col-12 about2">
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat blandit lectus eget sodales. Phasellus in dolor eget sem eleifend congue. Aenean sit amet ipsum eleifend, hendrerit sapien at, rutrum nisl. Ut diam sem, maximus eget enim faucibus, vestibulum laoreet orci. Etiam cursus vehicula odio, eget ullamcorper sapien finibus quis. Sed eget nibh eu diam convallis molestie. Vestibulum ac arcu laoreet, ultricies lorem eu, lacinia nisl. Proin ultricies commodo pretium. Sed quis luctus risus, quis sagittis tellus. Morbi porta massa tellus, eu porta ex pulvinar id. Quisque ut neque elit. Pellentesque commodo, turpis eget gravida commodo, odio nisi facilisis diam, sed tincidunt leo ipsum volutpat tellus.
</div>
</div>
<footer class="col-9">Created by Sam Coianiz 2017 &copy;</footer>
</body>
</html>
