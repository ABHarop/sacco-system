<?php
Session_start();
include('db.php');
if ( !isset($_POST['contact'], $_POST['password']) ) {
	exit('Please fill both the contact and password fields!');
}
date_default_timezone_set('Africa/Kampala');
$schedule = date("Y-m-d H:i:s");
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
	
		$activity="accessed admin information";  
		mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
		header('Location:admin.php');

		} else {
			echo "<script type='text/javascript'>alert('Account Deactivated');
			document.location='home.php'</script>";
		}
	} else {
		echo "<script type='text/javascript'>alert('Invalid Password!');
		document.location='home.php'</script>";
	}
} else {
	echo "<script type='text/javascript'>alert('Invalid Phone Number!');
	document.location='home.php'</script>";
}

	$stmt->close();
}
?>