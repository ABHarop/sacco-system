<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif;

    $memberId = $_POST["memberId"];
    $loanAmount = $_POST["loanAmount"];
    $loanInterest = $_POST["loanInterest"];
    $dateTaken = $_POST["dateTaken"];
    $dueDate = $_POST["dueDate"];

    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $adminId=$_SESSION['adminId'];
    $activity="issued out a loan";

    mysqli_query($con,"INSERT INTO loantb (`memberId`,`loanAmount`,`loanInterest`, `dateTaken`, `dueDate`) VALUES ('$memberId','$loanAmount','$loanInterest','$dateTaken','$dueDate')") or die(mysqli_error($con));

    mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully Added New Loan!');</script>";
    echo "<script>document.location='loan.php'</script>";
?>