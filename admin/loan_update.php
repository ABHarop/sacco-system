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
<h2 class="page-title">PAY LOAN</h2>
<centre>

<?php
include('db.php');
extract($_POST);
if(isset($save))
{  
  
	date_default_timezone_set('Africa/Kampala');
	$schedule = date("Y-m-d H:i:s");
	$adminId=$_SESSION['adminId'];
	$activity="recorded a loan paid back";
	mysqli_query($con,"INSERT INTO loanhist (`memberId`,`loanId`,`datePaid`,`amountPaid`) VALUES ('$memberId','$loanId','$datePaid','$amountPaid')") or die(mysqli_error($con));
	
	mysqli_query($con,"INSERT INTO admin_log(adminId,activity,schedule) VALUES('$adminId','$activity','$schedule')")or die(mysqli_error($con)); 
		
$err="<font color='blue'>Loan Payment Recorded</font>";

}
$sql=mysqli_query($con,"SELECT * FROM loantb WHERE loanId='".$_GET['loanId']."'");
$res=mysqli_fetch_array($sql);
?>
<div style="padding-left:42%; padding-top:6%; font-size:20px"><?php echo @$err;?></div>


<form method="POST" enctype='multipart/form-data' >

<div class="other-label">
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['memberId']; ?>" name="memberId" hidden readonly>
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['loanId']; ?>" name="loanId" hidden readonly>
</div>

<div class="other-label">Date Taken:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['dateTaken']; ?>" readonly>
</div>

<div class="other-label">Due Date:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['dueDate']; ?>" readonly>
</div>

<div class="other-label">Amount:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['loanAmount']; ?>" readonly>
</div>

<div class="other-label">Interest:
<input class="label-pay" style="background-color:rgb(199, 188, 188)" value="<?php echo $res['loanInterest']; ?>" readonly>
</div>

<div class="other-label">Date:
<input id="today" class="label-pay" type="date" placeholder="Date" name="datePaid" required>
</div>

<div class="other-label">Amount To Pay:
<input class="label-pay" placeholder="Enter Amount" name="amountPaid" required>
</div>



<center>
<div class="container">
<button class="signbtn" type="submit" name="save" >Save</button>
<button class="cancelbtn" type="button" onClick="location.href='loan.php'" >Back</button>
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