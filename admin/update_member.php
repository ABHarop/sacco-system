<?php
// We need to use sessions, so you should always start sessions using the below code.
Session_start();
// If the user is not logged in redirect to the login page…
If (!isset($_SESSION['loggedin'])) {
	Header('Location:../index.php');
	Exit;
}
?>
<!DOCTYPE html>
<html>
<title><?php include('title.php');?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootsrap/css/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="../js/js.js"></script>

<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 160px;background: black;padding-top: 46px}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
</style>

<body>
<?php include('menu.php');?>
<h2 class="page-title">UPDATE MEMBER DETAILS</h2>
<centre>

<?php
include('db.php');
extract($_POST);
if(isset($save))
{   
  $pic = $_FILES["image"]["name"];
  if ($pic=="")
  {	
    if ($_POST['image1']<>""){
      $pic=$_POST['image1'];
    }
    else
      $pic="default.gif";
  }
  else
  {
    $pic = $_FILES["image"]["name"];
    $type = $_FILES["image"]["type"];
    $size = $_FILES["image"]["size"];
    $temp = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];
  
    if ($error > 0){
      die("Error uploading file! Code $error.");
      }
    else{
      if($size > 100000000000) //conditions for the file
        {
        die("Format is not allowed or file size is too big!");
        }
    else
          {
      move_uploaded_file($temp, "image/".$pic);
          }
      }
  
  }
  date_default_timezone_set('Africa/Kampala');
  $schedule = date("Y-m-d H:i:s");
  $adminId=$_SESSION['adminId'];
  $activity="updated member information";
  $passnew = password_hash($password, PASSWORD_BCRYPT);
  $query2=mysqli_query($con,"SELECT * FROM membertb WHERE contact='$contact' ")or die(mysqli_error($con));
  $count=mysqli_num_rows($query2);
  if ($password<>''){
      mysqli_query($con,"UPDATE membertb SET photo='$pic', member_name='$member_name',gender='$gender',status='$status', username='$username', pass='$passnew',status='$status' WHERE memberId=' ".$_GET['memberId']."' ");
      mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
      $err="<font color='blue'>Saved, contact in use</font>";

    } else{
      if ($count>0)
      {
        mysqli_query($con,"UPDATE membertb SET photo='$pic', member_name='$member_name',gender='$gender', username='$username', status='$status'  WHERE memberId=' ".$_GET['memberId']."' ");
        mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
        $err="<font color='blue'>Saved, contact in use</font>";
      } 
      else {
        if($status=='Active'){
          mysqli_query($con,"UPDATE membertb SET photo='$pic', member_name='$member_name',gender='$gender',contact='$contact', username='$username', pass='$passnew', status='$status' WHERE memberId=' ".$_GET['memberId']."' ");
          mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
          $err="<font color='blue'>Member Detail Updated</font>";
      }else{
          mysqli_query($con,"UPDATE membertb SET photo='$pic', member_name='$member_name',gender='$gender',contact='$contact', username='$username', pass='$passnew', status='$status' WHERE memberId=' ".$_GET['memberId']."' ");
          mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con));
          $err="<font color='blue'>Member Detail Updated</font>";
      }
      }
}		
}

$sql=mysqli_query($con,"SELECT * FROM membertb WHERE memberId='".$_GET['memberId']."'");
$res=mysqli_fetch_array($sql);
//print_r($res);
?>
<div style="padding-left:43%; padding-top:5%; font-size:18px"><?php echo @$err;?></div>


<form method="POST" enctype='multipart/form-data' >

<div>
<div>
<center><img class="label-pay" style="width:17%;height:18%;margin-top:0.7%" alt="Member Photo" src="image/<?php echo $res['photo'];?>">
</center>
</div>

<div><center>
<input type="hidden" class="label-pay" name="image1" value="<?php echo $res['photo'];?>"> 
<input type="file" style="width:17%;margin-top:3px" class="label-pay" name="image"></<input>
</center>
</div>

<div class="other-label">Name:
<input class="label-pay" value="<?php echo $res['member_name']; ?>" name="member_name" required>
</div>

<div class="other-label" style="margin-right:45px">Gender:
    Male <input type="radio" <?php if($res[3]=="Male"){echo "checked";} ?> name="gender" value="Male" required/>
      Female <input type="radio" <?php if($res[3]=="Female"){echo "checked";} ?> name="gender" value="Female" />
      Other <input type="radio" <?php if($res[3]=="Other"){echo "checked";} ?> name="gender" value="Other" />
</div>

<div class="other-label">Contact:
<input class="label-pay" value="<?php echo $res['contact']; ?>" name="contact" required>
</div>

<div class="other-label" style="margin-right:45px">Account Status:
    Active <input type="radio" <?php if($res[6]=="Active"){echo "checked";} ?> name="status" value="Active" required/>
      Inactive <input type="radio" <?php if($res[6]=="Inactive"){echo "checked";} ?> name="status" value="Inactive" />
</div>

<div class="other-label">Username:
<input class="label-pay" value="<?php echo $res['username']; ?>" name="username" required>
</div>

<div class="other-label">Password:
<input class="label-pay" id="password" name="password" type="password" placeholder="Type new password">
</div>


<center>
<div class="container">
<button class="signbtn" type="submit" name="save" >Save</button>
<button type="button" class="cancelbtn" onClick="location.href='all_members.php'" >Back</button>
</div>
</center>
</div>
</form>

</centre>
</div>
</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>