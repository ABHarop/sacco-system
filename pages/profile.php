<?php session_start();
if(empty($_SESSION['memberId'])):
header('Location:../index.php');
endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php include('../admin/title.php');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body class="body">
<?php include('header.php');?>
<?php
include('db.php');

$memberId=$_SESSION['memberId'];
$sql=mysqli_query($con,"SELECT * FROM membertb WHERE memberId='$memberId'");
$res=mysqli_fetch_array($sql);
//print_r($res);
?>
<!-- Code for capturing inputs -->
<div>
<center>
<form method="POST" action="profile_update.php" onsubmit="return passwordMatch()" enctype="multipart/form-data" >
  <div class="container-register">
    <h2 class="status">UPDATE USER DETAIL</h2>
    <div>
    <input class="fill-date" style="color:maroon" name="joinDate" value="<?php echo $res['joinDate'];?>" readonly><br />
    <img class="fill-date" style="background-color:maroon" alt="Profile Picture" src="../admin/image/<?php echo $res['photo'];?>"><br />

    <input type="hidden" class="label-pay" name="image1" value="<?php echo $res['photo'];?>"> 
    <input type="file" class="fill-in" name="image">

    </div>

    <input class="fill-in" placeholder="Full Name" name="member_name" value="<?php echo $res['member_name'];?>" required>

    <input class="fill-in" placeholder="Tel. No." name="contact" value="<?php echo $res['contact'];?>" required>

    <div class="other-label" style="margin-right:45px">Gender:
      Male <input type="radio" <?php if($res[3]=="Male"){echo "checked";} ?> name="gender" value="Male" required/>
      Female <input type="radio" <?php if($res[3]=="Female"){echo "checked";} ?> name="gender" value="Female" />
      Other <input type="radio" <?php if($res[3]=="Other"){echo "checked";} ?> name="gender" value="Other" />
    </div>

    <input class="fill-in" placeholder="Username" name="username" value="<?php echo $res['username'];?>" required>
    <input class="fill-in" id="password" name="password" type="password" placeholder="Type new password"><br />

    <input class="fill-in" id="cfmPassword" type="password" name="newpassword" placeholder="Reenter new password">
    <input class="fill-in" id="date" type="password" name="passwordold" placeholder="Enter current password" required>
    <hr>

    <button type="submit" value="Submit" class="registerbtn">Save</button>
  </div>

</form>
</center>
</div>
<div class="bottom-nav">
<?php include('footer.php');?>
</div>
<script>
function passwordMatch() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("cfmPassword").value;
    var ok = true;
    if (pass1 != pass2) {
        alert("Passwords Do not match");
        document.getElementById("password").style.borderColor = "#E34234";
        document.getElementById("cfmPassword").style.borderColor = "#E34234";
        ok = false;
    }
    else {
        alert("Save Changes?");
    }
    return ok;
}
	</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>