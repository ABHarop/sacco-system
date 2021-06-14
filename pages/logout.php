
<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['memberId'])):
header('Location:../index.php');
endif;

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $memberId=$_SESSION['memberId'];
    $activity="logged out of the system";
    mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));
    session_destroy();
    Header('Location:../index.php');
?>
