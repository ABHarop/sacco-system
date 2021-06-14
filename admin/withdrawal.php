<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif; 

    $memberId = $_POST["memberId"];
    $date = $_POST["date"];
    $amountWithdrawn = $_POST["amountWithdrawn"];

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $adminId=$_SESSION['adminId'];
    $activity="approved withdraw of savings by a member";


    mysqli_query($con,"INSERT INTO withdrawtb (`memberId`,`date`,`amountWithdrawn`) VALUES ('$memberId','$date','$amountWithdrawn')") or die(mysqli_error($con));

    mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Withdraw Successful!');</script>";
    echo "<script>document.location='saving.php'</script>";
?>