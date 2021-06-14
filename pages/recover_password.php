<?php
include('db.php');

$contact = $_POST["contact"];
$password = $_POST['newpassword'];


$passnew=password_hash($password, PASSWORD_BCRYPT);

$query2=mysqli_query($con,"SELECT * FROM membertb WHERE contact='$contact' ")or die(mysqli_error($con));
$count=mysqli_num_rows($query2);
   
  if ($count>0)
  {

    mysqli_query($con,"UPDATE membertb SET pass='$passnew' WHERE contact='$contact' ")or die(mysqli_error($con));

      echo "<script type='text/javascript'>alert('Password Reset Successful!');</script>"; 
      echo "<script>document.location='../index.php'</script>";
  }
  else
  {	
    echo "<script type='text/javascript'>alert('Contact does not exist in the system!');</script>";
    echo "<script>document.location='../index.php'</script>";
  }
?>
