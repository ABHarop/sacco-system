
<?php
// We need to use sessions, so you should always start sessions using the below code.

// If the user is not logged in redirect to the login page…
If (!isset($_SESSION['loggedin'])) {
	Header('Location:../index.php');
	Exit;
}include('db.php');

$stmt1 = $con->prepare('SELECT photo, admin_name FROM admintb WHERE adminId = ?');
// In this case we can use the account ID to get the account info.
$stmt1->bind_param('i', $_SESSION['adminId']);
$stmt1->execute();
$stmt1->bind_result($photo,$admin_name);
$stmt1->fetch();
$stmt1->close();

?>

<!DOCTYPE html>
<html>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootsrap/css/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />

<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 200px;padding-top: 46px}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
</style>

<body>
<div class="top-link">
  <nav class="top-nav">DASHBOARD</nav>
</div>

<div class="w3-sidebar w3-bar-block w3-medium w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img alt="Admin Photo" src="image/<?=$photo?>" style="width:100%;height:25%">
  <input style="with:100%;color:#e6f0ff;background-color:black;text-align:left;margin-top:16px;margin-bottom:16px;border: 0px solid #ccc;font-size:16px;font-weight: lighter;word-wrap:true;text-align:center" value="<?=$admin_name?>" readonly>
  <a href="home.php" class="w3-bar-item w3-button w3-padding-medium w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>OVERVIEW</p>
  </a>
  <a href="member.php" class="w3-bar-item w3-button w3-padding-medium w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="saving.php" class="w3-bar-item w3-button w3-padding-medium w3-hover-black">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>SAVINGS</p>
  </a>
  <a href="loan.php" class="w3-bar-item w3-button w3-padding-medium w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>LOAN</p>
  </a>
  <button  style="width:100%;background:transparent;padding: 0px;border: none;" onclick="document.getElementById('id05').style.display='block'"><a class="w3-bar-item w3-button w3-padding-medium w3-hover-black">
    <p>MANAGEMENT</p>
  </a></button>
  <a href="logout.php" class="w3-bar-item w3-button w3-padding-medium w3-hover-black">
    <p>LOG OUT</p>
  </a>
</div>


<!-- Page Content -->
<!-- Code for quering for password -->
<div id="id05" class="modal1"> 
  
  <form class="modal-content1 animate1" action = "manage.php" method = "POST" enctype = "multipart/form-data">
    <div class="imgcontainer">
      <div class="imgcontainer">
      <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

      <h3 class="modal-title">Enter Credentials</h3>
    </div>
    <div class="container-register">
      <label class="label">Phone Number</label>
      <input class="fill-in" name="contact" placeholder="Type Phone Number" required>
    </div>
    <div class="container-register">
      <label class="label">Password</label>
      <input type="password" class="fill-in" name="password" placeholder="Type Password" required>
    </div>
<center>
    <div class="container" style="background-color:#f1f1f1">
    <button class="signbtn" onclick="document.getElementById('id05').style.display='block'" style="width:auto">Submit</button>
      <button type="button" onclick="document.getElementById('id05').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
</center>
  </form>
  
</div>


<!-- END PAGE CONTENT -->
</div>
<div class="bottom-nav">
<?php include('footer.php');?>
</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
