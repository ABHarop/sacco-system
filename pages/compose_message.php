<?php
include('db.php');

    $memberId = $_POST["memberId"];
    $dateComposed = $_POST["dateComposed"];
    $messageBody = $_POST["messageBody"];
    
    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $activity="sent a message"; 

    mysqli_query($con,"INSERT INTO messagetb (`memberId`,`sender`,`dateComposed`,`messageBody`) VALUES ('$memberId','$memberId','$dateComposed','$messageBody')") or die(mysqli_error($con));

    mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Message Sent!');</script>";
    echo "<script>document.location='private.php'</script>";
?>