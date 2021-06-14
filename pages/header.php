<?php

include('db.php');

$stmt1 = $con->prepare('SELECT member_name FROM membertb WHERE memberId = ?');
// In this case we can use the account ID to get the account info.
$stmt1->bind_param('i', $_SESSION['memberId']);
$stmt1->execute();
$stmt1->bind_result($member_name);
$stmt1->fetch();
$stmt1->close();
?>


<!DOCTYPE html>
<html>

<title><?php include('../admin/title.php');?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<style>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
</style>

<body>

<div class="top-link" id="mytoplink">
  <a href="home.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Messages 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="private.php">Private</a>
      <a href="public.php">Public</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Report 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="sreport.php">Savings Report</a>
      <a href="lreport.php">Loan Report</a>
      <a href="wreport.php">Withdraw Report</a>
    </div>
  </div> 
  <a href="profile.php"><?=$member_name?></a>
  <a href="history.php">Activity Log</a>
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>



<script src="../js/bootstrap.min.js"></script>
<script src="../js/js.js"></script>

</body>
</html>
