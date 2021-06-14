<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif;

    $memberId = $_POST["memberId"];
    $date = $_POST["date"];
    $amount = $_POST["amount"];

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $adminId=$_SESSION['adminId'];
    $activity="added a new saving";


    mysqli_query($con,"INSERT INTO savehist (`memberId`,`date`,`amount`) VALUES ('$memberId','$date','$amount')") or die(mysqli_error($con));

    mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully Added New Savings!');</script>";
    echo "<script>document.location='saving.php'</script>";
?>