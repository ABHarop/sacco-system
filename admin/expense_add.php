<?php
include('db.php');

    $date = $_POST["date"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];


    mysqli_query($con,"INSERT INTO expensetb (`date`,`description`, `amount`) VALUES ('$date','$description','$amount')") or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('New Expense Added!');</script>";
    echo "<script>document.location='home.php'</script>";
?>