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
<body></body>
<?php include('menu.php');?>
<?php include('db.php');?>
<h2 class="page-title">OVERVIEW</h2>
<form method="POST">
<input class="searchbox" type="date" id="today" style=" width:auto;color:red; font-weight:lighter; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:25px; border: 0px solid #ccc; background-color:blanchedalmond; font-style:italic" readonly>
</form>
<button class="add-btn" onClick="location.href='expense.php'" style="width:auto">All Expenses</button>
<button class="add-btn" onclick="document.getElementById('id02').style.display='block'" style="width:auto;margin-left:2px;background-color:maroon">New Expense</button>
<button class="add-btn" style="margin-left:2px;width:auto;background-color:#003300" onClick="location.href='general_report.php'" style="width:auto">SACCO Report</button>
<?php
include('db.php');
// total savings
$q2=mysqli_query($con,"SELECT SUM(amount) AS total FROM savehist ");
$res=mysqli_fetch_assoc($q2);

// loan balance
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
<!-- Code for members -->
<table>
    <tr class="label-overview" style="padding-left: 0%;margin-left: 15%;width: 85%">
    <th class="th">Total Savings <br />
    UGX<input class="display-data" value="<?php echo $res['total']; ?>" readonly> </th>
    <th class="th">Loan Paid <br />
    UGX<input class="display-data" value="<?php echo $loanpaid['totalPaid']; ?>" readonly> </th>
    <th class="th">Loan Out <br />
    UGX<input class="display-data" value="<?php echo $loan['loanBalance']; ?>" readonly> </th>
    <th class="th">Profit <br />
    UGX<input class="display-data" value="<?php echo $profit['profits']; ?>" readonly> </th>
    <th class="th">Expenses <br />
    UGX<input class="display-data" value="<?php echo $expense['expense']; ?>" readonly> </th>
    </tr>    
</table>

<table>
    <tr class="label-funds" style="margin-top:3%;padding-left: 0%;margin-left: 25%;width: 85%">
    <th class="th" >Total Withdrawn<br />
    <input class="display-data" value="<?php echo $withraw['afterWithdraw']; ?>" readonly> </th>
    <th class="th">No. of Members <br />
    <input class="display-data" value="<?php echo $totMember['totalMembers']; ?>" readonly> </th>
    <th class="th">Active Members <br />
    <input class="display-data" value="<?php echo $totActiveMember['totalActiveMembers']; ?>" readonly> </th> 
    <th class="th">Inactive Members <br />
    <input class="display-data" value="<?php echo $totInactiveMember['totalInactiveMembers']; ?>" readonly> </th>   
</table>
<table>
<tr class="label-funds" style="margin-left:8%;margin-top:5%;color:#003300;width:200%">
<th class="th">Net Available Funds <br />
UGX<input class="display-data" value="<?php echo $bal['realBalance']; ?>" readonly></th>
</tr>
</table>

<!-- Code for expense -->
<div id="id02" class="modal1">
  
  <form class="modal-content1 animate1" action = "expense_add.php" method = "POST" enctype = "multipart/form-data">
    <div class="imgcontainer">
      <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

      <h3 class="modal-title">Add New Expenditure</h3>
    </div>
    <div class="container-register">
      <label class="label">Date</label>
      <input id="StartDate" type="date" class="date" style="text-align:center" name="date" readonly>
      <label class="label">Description</label>
      <input class="fill-in" placeholder="Enter description" name="description" required>
      <label class="label">Amount</label>
      <input class="fill-in" type="number" placeholder="Enter Amount" name="amount" required>


</div>
<center>
   <div class="container" style="background-color:#f1f1f1">
   <button class="signbtn" onclick="document.getElementById('id02').style.display='block'" style="width:auto">Submit</button>
   <b<abutton type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</b<abutton>
    </div>
</center>
  </form>
  
</div>


</div>
</div>
</div>
<script>
var field = document.querySelector('#today');
var date = new Date();

//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>
<script>
var field = document.querySelector('#StartDate');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>