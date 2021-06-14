<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif; 

    $adminId = $_POST["adminId"];
    $dateComposed = $_POST["dateComposed"];
    $messageBody = $_POST["messageBody"];

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $adminId=$_SESSION['adminId'];
    $activity="sent an announcement";
    $dateComposed = date("Y-m-d H:i:s");


    mysqli_query($con,"INSERT INTO publicmessagetb (`adminId`,`dateComposed`,`messageBody`) VALUES ('$adminId','$dateComposed','$messageBody')") or die(mysqli_error($con));

    mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Announcement Published!');</script>";
    echo "<script>document.location='member.php'</script>";
?>