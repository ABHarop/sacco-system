<?php
include 'db.php'; 
session_start();
if(empty($_SESSION['adminId'])):
header('Location:../index.php');
endif;

$member_name = $_POST["member_name"];
$gender = $_POST["gender"];
$contact = $_POST["contact"];
$joinDate = $_POST["joinDate"];
$username = $_POST['username'];
$password = $_POST['password'];

date_default_timezone_set('Africa/Kampala');
$schedule = date("Y-m-d H:i:s");
$adminId=$_SESSION['adminId'];
$activity="added new member";


$hash = password_hash($password, PASSWORD_BCRYPT);

$query2=mysqli_query($con,"SELECT * FROM membertb WHERE contact='$contact' ")or die(mysqli_error($con));
$count=mysqli_num_rows($query2);
   

   
  if ($count>0)
  {
      echo "<script type='text/javascript'>alert('Phone number already exist!');</script>"; 
      echo "<script>document.location='member.php'</script>";
  }
  else
  {	

      $pic = $_FILES['image']['name'];
      if ($pic=='')
      {
          $pic='student.png';
      }
      else
      {
          $pic = $_FILES['image']['name'];
          $type = $_FILES['image']['type'];
          $size = $_FILES['image']['size'];
          $temp = $_FILES['image']['tmp_name'];
          $error = $_FILES['image']['error'];
      
          if ($error > 0){
              die('Error uploading file! Code $error.');
              }
          else{
              if($size > 100000000000) //conditions for the file
                  {
                  die('Format is not allowed or file size is too big!');
                  }
          else
                {
              move_uploaded_file($temp, 'image/'.$pic);
                }
              }
      }

      mysqli_query($con,"INSERT INTO membertb (`photo`,`member_name`,`gender`, `contact`, `joinDate`,`username`,`pass`) VALUES ('$pic','$member_name','$gender','$contact','$joinDate','$username','$hash')") or die(mysqli_error($con));
      
      mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully Added New Member!');</script>";
    echo "<script>document.location='member.php'</script>";
  }
?>
