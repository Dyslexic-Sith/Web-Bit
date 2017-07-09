<html>
<?php
  session_set_cookie_params(0);
  session_start();
  session_unset();
  session_destroy();
  header("Refresh: 3, URL=index.php");
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
    <h1 style='color:#d60000;'>You have been logged out. Taking you back to the homepage.</h1>
  </div>

  <footer class='col-8'>Created by Sam Coianiz 2017 &copy;</footer>
  </body>";
 ?>
</html>
