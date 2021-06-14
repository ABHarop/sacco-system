<?php
Session_start();
include('database/db.php');
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['contact'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the contact and password fields!');
}
date_default_timezone_set('Africa/Kampala');
$schedule = date("Y-m-d H:i:s");
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("SELECT memberId, status, pass FROM membertb WHERE contact = ? ")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the contact is a string so we use "s"
	$stmt->bind_param('s', $_POST['contact']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
If ($stmt->num_rows > 0) {
	$stmt->bind_result($memberId,$status,$pass);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	//password_verify($_POST['password'], $password)
	//$_POST['password'] === $password
	If (password_verify($_POST["password"], $pass)) {
	
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		if($status=='Active'){
		Session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['memberId'] = $memberId;
		$_SESSION['adminId'] = $adminId;
		$_SESSION['name'] = $_POST['contact'];
	
		$activity="logged into the system";  
		mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));
		header('Location:pages/home.php');

		} else {
			echo "<script type='text/javascript'>alert('Account Suspended! Contact Admin');
			document.location='index.php'</script>";
		}
	} else {
		echo "<script type='text/javascript'>alert('Invalid Password, please try again');
		document.location='index.php'</script>";
	}
} else {
	echo "<script type='text/javascript'>alert('Invalid Phone Number!');
	document.location='index.php'</script>";
}

	$stmt->close();
}

// Log into admin
if ($stmt = $con->prepare("SELECT adminId, status, pass FROM admintb WHERE contact = ? ")) {
	$stmt->bind_param('s', $_POST['contact']);
	$stmt->execute();
	$stmt->store_result();
	If ($stmt->num_rows > 0) {
		$stmt->bind_result($adminId,$status,$pass);
		$stmt->fetch();
		If (password_verify($_POST["password"], $pass)) {

			if($status=='Active'){
			Session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['adminId'] = $adminId;
			$_SESSION['name'] = $_POST['contact'];

			$activity="logged into the system";  
			mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
			header('Location:admin/home.php');

			} 
		}

		$stmt->close();
	}	
}
?>
