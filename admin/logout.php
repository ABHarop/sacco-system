<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif; 

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $adminId=$_SESSION['adminId'];
    $activity="logged out of the system";
    mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
    session_destroy();
    Header('Location:../index.php');
?>