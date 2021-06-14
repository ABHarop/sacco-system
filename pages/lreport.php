<?php
// We need to use sessions, so you should always start sessions using the below code.
Session_start();
// If the user is not logged in redirect to the login page…
If (!isset($_SESSION['loggedin'])) {
	Header('Location:../index.php');
	Exit;
}
include('db.php');

$stmt1 = $con->prepare('SELECT photo, member_name, gender, contact FROM membertb WHERE memberId = ?');
// In this case we can use the account ID to get the account info.
$stmt1->bind_param('i', $_SESSION['memberId']);
$stmt1->execute();
$stmt1->bind_result($photo, $member_name, $gender, $contact);
$stmt1->fetch();
$stmt1->close();

// Statement for computing savings
$stmt2 = $con->prepare('SELECT date, SUM(amount) AS totalSaving FROM savehist WHERE memberId = ?');
$stmt2->bind_param('i', $_SESSION['memberId']);
$stmt2->execute();
$stmt2->bind_result($date, $totalSaving);
$stmt2->fetch();
$stmt2->close();

?>
<!DOCTYPE html>
<html>
<head>
<title><?php include('../admin/title.php');?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="body" style="background-color:white">
    <div class="dontprint">
<?php include('header.php');?>
</div>

<!-- Page Container -->
<div class="report">
  <p><i class="report-head">ST AUGUSTINE YOUTH SACCO</i> <br />
  <i class="report-head4">PERSONAL LOAN REPORT</i></p>
	<i class="report-head2"><?=$member_name?></i><br />
	<i class="report-head3"><?=$contact?></i><br />
  <i class="report-head4"><?php
  date_default_timezone_set('Africa/Kampala'); echo date("M d, Y h:i a");?></i></p>
</div>
                                
<button class="add-btn dontprint" style="width:auto;padding-left:14px;padding-right:14px;margin-left:5%"  onclick="window.print()" style="width:auto">Print</button>

<button style="color:blanchedalmond; width:80px; font-weight:bold;background-color:#f44336;margin-left:2px" class="add-btn dontprint" onclick="location.href='home.php'" style="width:auto">Back</button>

<form >
      <div >
        
  <?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM loantb WHERE memberId = '$memberId' ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;font-style: italic;font-size:20px;padding-left:14px;padding-right:14px;margin-left:5%'>No Loan Data Available...</h2>";

      }
      else
      {
      ?>

              <table  id="membertb" style="margin-top:0%;margin-bottom:3%;width: 90%;margin-left:5%" >
              <tr>
          <th class="thead">No.</th>
          <th class="thead">Date</th>
          <th class="thead">Amount</th>
          <th class="thead">Paid</th>
        </tr>
        <?php
        $inc = 1;
        while($row = mysqli_fetch_array($q)){

        $q1=mysqli_query($con,"SELECT * FROM loantb WHERE loanId='".$row['loanId']."' ");
        $row=mysqli_fetch_assoc($q1); 
        // for computing paid amount on a given loan
        $q2=mysqli_query($con,"SELECT SUM(amountPaid) AS paid FROM loanhist WHERE loanId='".$row['loanId']."' ");
        $r2=mysqli_fetch_assoc($q2);
        
        echo "<Tr>";
        echo "<td>".$inc."</td>";
        echo "<td>".$row['dateTaken']."</td>";
        echo "<td>".$row['loanAmount']."</td>";
        echo "<td>".$r2['paid']."</td>";
        ?>
        <?php
      echo "</Tr>";
      $inc++;
      }
      ?>
          
      </table>
<?php }?>
  <div style="padding-left:42%; padding-top:3%; font-size:20px; font-style: italic;"><?php echo @$err;?></div>
  </form>
  <div class="bottom-nav">
<?php include('footer.php');?>
</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
