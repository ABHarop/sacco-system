<?php session_start();
if(empty($_SESSION['memberId'])):
header('Location:../index.php');
endif;

include('db.php');

	$memberId = $_SESSION['memberId'];
	$member_name =$_POST['member_name'];
    $username =$_POST['username'];
    $gender =$_POST['gender'];
	$contact =$_POST['contact'];
	$password =$_POST['password'];
    $old =$_POST['passwordold'];

      $pic = $_FILES['image']['name'];
      if ($pic=='')
      {	
            if ($_POST['image1']<>""){
              $pic=$_POST['image1'];
            }
            else
              $pic="default.gif"; 
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
              move_uploaded_file($temp, '../admin/image/'.$pic);
                }
              }
      }
    
    date_default_timezone_set('Africa/Kampala');
    $schedule = date("Y-m-d H:i:s");
    $activity="updated account information"; 
	
    $passnew=password_hash($password, PASSWORD_BCRYPT);
    
    $query2=mysqli_query($con,"SELECT * FROM membertb WHERE contact='$contact' ")or die(mysqli_error($con));
    $count=mysqli_num_rows($query2);
   

   
  if ($count>0)
  {
    $query=mysqli_query($con,"SELECT pass FROM membertb WHERE memberId='$memberId' ")or die(mysqli_error($con));
	$row=mysqli_fetch_array($query);
	

    $pass = $row['pass'];
    If (password_verify($_POST["passwordold"], $pass))
    {
        if ($password<>"")
        {
            mysqli_query($con," UPDATE membertb SET photo='$pic', member_name='$member_name',gender='$gender', username='$username', pass='$passnew' WHERE memberId='$memberId' ")or die(mysqli_error($con));
            mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));
        }
        else
        {
            mysqli_query($con,"UPDATE membertb SET photo='$pic', member_name='$member_name', gender='$gender', username='$username' WHERE memberId='$memberId' ")or die(mysqli_error($con));
            mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));
            
        }
        
        $_SESSION['member_name']=$member_name;
        echo "<script type='text/javascript'>alert('Saved, contact in use');</script>";
        echo "<script>document.location='profile.php'</script>";  
    }
    else
    {
        echo "<script type='text/javascript'>alert('Invalid Password!');</script>";
        echo "<script>document.location='profile.php'</script>";  
    }

  }
  else
  {	

	$query=mysqli_query($con,"SELECT pass FROM membertb WHERE memberId='$memberId' ")or die(mysqli_error($con));
	$row=mysqli_fetch_array($query);
	

    $pass = $row['pass'];
    If (password_verify($_POST["passwordold"], $pass))
    {
        if ($password<>"")
        {
            mysqli_query($con," UPDATE membertb SET photo='$pic', member_name='$member_name', contact='$contact',gender='$gender', username='$username', pass='$passnew' WHERE memberId='$memberId' ")or die(mysqli_error($con));
            mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));
        }
        else
        {
            mysqli_query($con,"UPDATE membertb SET photo='$pic', member_name='$member_name',contact='$contact', gender='$gender', username='$username' WHERE memberId='$memberId' ")or die(mysqli_error($con));
            mysqli_query($con,"INSERT INTO historytb(memberId,activity,schedule) VALUES('$memberId','$activity','$schedule')")or die(mysqli_error($con));
            
            
        }
        
        $_SESSION['member_name']=$member_name;
        echo "<script type='text/javascript'>alert('User Detail Updated');</script>";
        echo "<script>document.location='profile.php'</script>";  
    }
    else
    {
        echo "<script type='text/javascript'>alert('Invalid Password!');</script>";
        echo "<script>document.location='profile.php'</script>";  
    }
}
?>
