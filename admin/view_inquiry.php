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
<h2 class="page-title">VIEW INQUIRY</h2>
<centre>

<?php
include('db.php');
extract($_POST);

$sql=mysqli_query($con,"SELECT * FROM inquirytb WHERE inquiryId='".$_GET['inquiryId']."'");
$res=mysqli_fetch_array($sql);
?>
<div style="padding-left:42%; padding-top:6%; font-size:20px"><?php echo @$err;?></div>


<form method="POST" enctype='multipart/form-data' >

<div class="other-label">Date/Time:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['dateComposed']; ?>" readonly>
</div>

<div class="other-label">Sender:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['member']; ?>" readonly>
</div>

<div class="other-label">Contact:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['contact']; ?>" readonly>
</div>

<div class="other-label">Subject:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['subject']; ?>" readonly>
</div>

<div class="other-label">
<textarea  name='message' rows=6 style="resize:none;font-weight:lighter;width:30%;font-size:14px" readonly><?php echo $res['message'];?></textarea>
</div>




<center>
<div class="container">
<button class="cancelbtn" type="button" onClick="location.href='inquiry.php'" >Back</button>
</div>
</center>
</div>
</form>

</centre>
</div>
</div>
<script>
var field = document.querySelector('#today');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>

<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>