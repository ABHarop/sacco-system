<?php
// We need to use sessions, so you should always start sessions using the below code.
Session_start();
// If the user is not logged in redirect to the login page…
If (!isset($_SESSION['loggedin'])) {
	Header('Location:../index.php');
	Exit;
}
include('db.php');

$stmt1 = $con->prepare('SELECT admin_name, contact FROM admintb WHERE adminId = ?');
// In this case we can use the account ID to get the account info.
$stmt1->bind_param('i', $_SESSION['adminId']);
$stmt1->execute();
$stmt1->bind_result($admin_name,$contact);
$stmt1->fetch();
$stmt1->close();


?>
<!DOCTYPE html>
<html>
<title><?php include('title.php');?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="bootsrap/css/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="../js/js.js"></script>

<body style="background-color:white">

    <div class="report">
	<p><i class="report-head">ST AUGUSTINE YOUTH SACCO</i> <br />
	<i class="report-head4">GROUP REPORT</i></p>
	<i class="report-head4"><?php
	date_default_timezone_set('Africa/Kampala');
	 echo date("M d, Y h:i a");?></i></p>
                  
                  
				  <h6> </h6> 

								</div>
<button class="add-btn dontprint" style="width:auto;padding-left:14px;padding-right:14px;margin-left:5%"  onclick="window.print()" style="width:auto">Print</button>

<button style="color:blanchedalmond; width:80px; font-weight:bold;background-color:#f44336;margin-left:2px" class="add-btn dontprint" onclick="location.href='home.php'" style="width:auto">Back</button>

<?php
include('db.php');
// code for the summary of the report
// total savings
$q2=mysqli_query($con,"SELECT SUM(amount) AS total FROM savehist ");
$res=mysqli_fetch_assoc($q2);

$q6=mysqli_query($con,"SELECT ROUND(((SELECT SUM(((loanInterest / 100) * loanAmount)+loanAmount) FROM loantb) - (SELECT SUM(amountPaid) FROM loanhist)), 2) AS loanBalance ");
$loan=mysqli_fetch_assoc($q6);



// total loan paid
$q4=mysqli_query($con,"SELECT SUM(amountPaid) AS totalPaid FROM loanhist ");
$loanpaid=mysqli_fetch_assoc($q4);

// total expense
$q5=mysqli_query($con,"SELECT SUM(amount) AS expense FROM expensetb ");
$expense=mysqli_fetch_assoc($q5);

// net available funds
$q6=mysqli_query($con,"SELECT ((SELECT SUM(amount) FROM savehist) + (SELECT SUM(amountPaid) FROM loanhist)) - ((SELECT SUM(amount) FROM expensetb) +   (SELECT SUM(loanAmount) FROM loantb) + (SELECT SUM(amountWithdrawn) FROM withdrawtb)) AS realBalance ");
$bal=mysqli_fetch_assoc($q6);


// total members
$q7=mysqli_query($con,"SELECT COUNT(memberId) AS totalMembers FROM membertb ");
$totMember=mysqli_fetch_assoc($q7);

// total active members
$q8=mysqli_query($con,"SELECT COUNT(memberId) AS totalActiveMembers FROM membertb WHERE status='Active' ");
$totActiveMember=mysqli_fetch_assoc($q8);

// total inactive members
$q9=mysqli_query($con,"SELECT COUNT(memberId) AS totalInactiveMembers FROM membertb WHERE status='Inactive' ");
$totInactiveMember=mysqli_fetch_assoc($q9);

// amount withdran
$q10=mysqli_query($con,"SELECT SUM(amountWithdrawn) AS afterWithdraw FROM withdrawtb ");
$withraw=mysqli_fetch_assoc($q10);

// Group Profit
$q11=mysqli_query($con,"SELECT ROUND((SELECT SUM(amountPaid) FROM loanhist) - (SELECT SUM(loanAmount) FROM loantb) , 2) AS profits ");
$profit=mysqli_fetch_assoc($q11);

?>
<table >
    <tr  style="margin-top:0%;margin-bottom:2%;width: 100%;">
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Total Savings <br />
    UGX<input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $res['total']; ?>" readonly> </th>
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Loan Paid <br />
    UGX<input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $loanpaid['totalPaid']; ?>" readonly> </th>
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Loan Out <br />
    UGX<input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $loan['loanBalance']; ?>" readonly> </th>
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Profit<br />
    UGX<input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $profit['profits']; ?>" readonly> </th>
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Withdrawn<br />
    UGX<input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $withraw['afterWithdraw']; ?>" readonly> </th>
    </tr>    
</table>
<hr style="visibility:hidden;margin-top:0%">
<table>
    <tr style="margin-top:0%;margin-bottom:3%;width: 100%" >
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Expenses<br />
    <input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $expense['expense']; ?>" readonly> </th>
	<th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Available Funds<br />
    <input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $bal['realBalance']; ?>" readonly> </th>
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">No. of Members <br />
    <input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $totMember['totalMembers']; ?>" readonly> </th>
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Active <br />
    <input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $totActiveMember['totalActiveMembers']; ?>" readonly> </th> 
    <th class="th" style="background-color:white;color:black;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:18px">Inactive <br />
    <input class="display-data" style="background-color:white;margin-top:2px;text-align:center" value="<?php echo $totInactiveMember['totalInactiveMembers']; ?>" readonly> </th>   
</table>


<?php
// code the report table 
include('db.php');
$q=mysqli_query($con,"SELECT * FROM `membertb` ORDER BY member_name ASC ");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red; padding-left:230px'>No Results Found !!!</h2>";

}
else
{
?>
<div class="report-form">

<table style="padding-left:200px"  class="report-table" id="membertb" >
  <tr>
    <th>No.</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Contact</th>
	<th>Total Savings</th>
	<th>Status</th>
  </tr>

<?php
$inc=1;
while($row = mysqli_fetch_array($q)){

$q1=mysqli_query($con,"SELECT * FROM membertb WHERE memberId='".$row['memberId']."' ");
$r1=mysqli_fetch_assoc($q1);

$q2=mysqli_query($con,"SELECT SUM(amount) AS totalSaving FROM savehist WHERE memberId='".$row['memberId']."' ");
$r2=mysqli_fetch_assoc($q2);

// available savinggs for each member
$q2=mysqli_query($con,"SELECT ((SELECT SUM(amount) FROM savehist WHERE memberId='".$row['memberId']."') - (SELECT SUM(amountWithdrawn) FROM withdrawtb WHERE memberId='".$row['memberId']."')) AS balance ");
$r2=mysqli_fetch_assoc($q2);


echo "<Tr>";
echo "<td>".$inc."</td>";
echo "<td>".$r1['member_name']."</td>";
echo "<td>".$row['gender']."</td>";
echo "<td>".$row['contact']."</td>";
echo "<td>".$r2['balance']."</td>";
echo "<td>".$row['status']."</td>";
?>


<?php 
echo "</Tr>";
$inc++;
} 
		?>

</table>

<?php }?>

</div>


</div>
</div>
<table class="add-btn" style="width:auto;background-color:white;margin-left:5%;color:black">
<tr><th><i>Prepared by:</i></th></tr>
<td><i class="report-head2"><?=$admin_name?></i></td>
</table>

<script>
var field = document.querySelector('#composeDate');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>

<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>