<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif; 

    $memberId = $_POST["memberId"];
    $dateComposed = $_POST["dateComposed"];
    $messageBody = $_POST["messageBody"];

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $adminId=$_SESSION['adminId'];
    $activity="sent a message";


    mysqli_query($con,"INSERT INTO messagetb (`memberId`,`dateComposed`,`messageBody`, `sender`) VALUES ('$memberId','$dateComposed','$messageBody','Admin')") or die(mysqli_error($con));

    mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Message Sent!');</script>";
    echo "<script>document.location='member.php'</script>";
?>