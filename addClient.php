<html>
<body>
<link href="toastr.css" rel="stylesheet"/>
<script src="toastr.js"></script>
    <?php
    session_set_cookie_params(0);
    $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
	
    /* Grab all the field names and variables from the previous page. */
    if ($_POST['bname'] != null){
		$bname = mysqli_real_escape_string($db, $_POST['bname']);
	}
    else $bname = null;
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	if($_POST['fax'] != null){
    $fax = $_POST['fax'];}
	else $fax = null;
	if($_POST['unit'] != null){
		$unit = $_POST['unit'];
	}
	else $unit = null;
	$address = mysqli_real_escape_string($db, $_POST['address']);
    $suburb = mysqli_real_escape_string($db, $_POST['suburb']);
    $postcode = $_POST['postcode'];
	$state = $_POST['state'];
	if($_POST['notes'] != null){
	$details = mysqli_real_escape_string($db, $_POST['notes']);
  $details = addslashes($_POST['notes']);
	}
	else $details = null;
	$username = $_POST['username'];
	$password = $_POST['password'];
/* End Region */


	if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
	}
	else{
	$sql_insert_client = "INSERT INTO Client(clientFirstName, clientLastName, clientPhone, clientEmail, clientFax, clientBusinessName, status) VALUES('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$fax."', '".$bname."', '1');";
	$result = mysqli_query($db, $sql_insert_client);

    $sql_select_new = "SELECT DISTINCT MAX(clientID) FROM Client;";
    $new_client1 = mysqli_query($db, $sql_select_new);
	$new_client_array = mysqli_fetch_array($new_client1);

    $new_ID = $new_client_array[0];

	$sql_insert_location = "INSERT INTO ClientLocation(clientID, clientLocationUnit, clientLocationStreet, clientLocationSuburb, clientLocationPostcode, clientLocationState, clientLocationDetails, isPrimary) VALUES('".$new_ID."', '".$unit."', '".$address."', '".$suburb."', '".$postcode."', '".$state."', '".$details."', '1')";
	$new_location = mysqli_query($db, $sql_insert_location);

	$sql_insert_login = "INSERT INTO ClientLogin(clientID, clientUsername, clientPassword) VALUES ('".$new_ID."', '".$username."',  '".$password."')";
	$new_login = mysqli_query($db, $sql_insert_login);

	$new_client = "SELECT clientFirstName, clientID FROM Client WHERE clientID =".$new_ID;

  $sql_select_client = mysqli_query($db, $new_client);
	if(!$result || !$new_location || !$new_login){
		echo "Error: <br>";
    header ('Refresh:3, URL=signUp.php');
	}else{
		if(mysqli_num_rows($sql_select_client) != 0){
			session_start();
      $row = mysqli_fetch_array($sql_select_client);
			$_SESSION["client"] = $row["clientFirstName"];
      $_SESSION["clientID"] = $row["clientID"];
	  $_SESSION["success"] = 1;
            header('Location: clientHome.php');

	}
    }
	}
        ?>
		</body>
</html>
