<?php
include('db.php');
    $dateComposed = $_POST["dateComposed"];
    $member = $_POST["member"];
    $contact = $_POST['contact'];
    $subject = $_POST['subject'];
    $message = $_POST["message"];

    date_default_timezone_set('Africa/Kampala');
    $dateComposed = date("Y-m-d H:i:s");


    mysqli_query($con,"INSERT INTO inquirytb (`member`,`dateComposed`,`subject`,`contact`,`message`) VALUES ('$member','$dateComposed','$subject','$contact','$message')") or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Message Sent!');</script>";
    echo "<script>document.location='../index.php'</script>";
?>