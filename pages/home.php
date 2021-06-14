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

// Statement for computing total withdrawal
$stmt2 = $con->prepare('SELECT SUM(amountWithdrawn) AS totalWithdraw FROM withdrawtb WHERE memberId = ?');
$stmt2->bind_param('i', $_SESSION['memberId']);
$stmt2->execute();
$stmt2->bind_result($totalWithdraw);
$stmt2->fetch();
$stmt2->close();

// Statement for computing total loan paid
$stmt2 = $con->prepare('SELECT SUM(amountPaid) AS totalLoan FROM loanhist WHERE memberId = ?');
$stmt2->bind_param('i', $_SESSION['memberId']);
$stmt2->execute();
$stmt2->bind_result($totalLoan);
$stmt2->fetch();
$stmt2->close();


?>

<!DOCTYPE html>
<html>
<head>
<title><?php include('../admin/title.php');?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

</style>
<body class="body">
<div>
<?php include('header.php');?>
</div>

<!-- Page Container -->


  <!-- The Grid -->
  <div class="w3-row-padding">


  <form method="GET">
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <center><img alt="Profile Picture" src="../admin/image/<?=$photo?>"></center>
        </div><br />
        

        <div class="w3-container">
        <form method="POST">
        <h4><?=$member_name?></h4>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><input class="accountname" value="<?=$contact?>" readonly></input></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><input class="accountname" value="<?=$gender?>" readonly></input></p>
          <!-- Total Savings -->
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal">Total Savings</i><input class="accountname" value="<?=$totalSaving?>" readonly></input></p>
          <!-- Total Savings -->
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal">Total Withdraw</i><input class="accountname" value="<?=$totalWithdraw?>" readonly></input></p>
          <!-- Total loan paid -->
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal">Total Loan Paid</i><input class="accountname" value="<?=$totalLoan?>" readonly></input></p>
          

        </form>

          <br>
        </div>
      </div><br>


    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    <center>
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="status">FINANCIAL STATUS</h2>
  <form>
      <div class="w3-container w3-card w3-white">
        <h3 class="savings">Savings Information</h3>

        
  <?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM savehist WHERE memberId = '$memberId' ORDER BY date DESC ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;font-style: italic;font-size:20px'>No Savings Data Available...</h2>";

      }
      else
      {
      ?>

              <table  id="membertb" >
        <tr>
          <th class="thead">Date</th>
          <th class="thead">Amount</th>
        </tr>
        <?php

      while($row=mysqli_fetch_assoc($q))
      {
        $q1=mysqli_query($con,"SELECT * FROM savehist WHERE saveId='".$row['saveId']."'  ");
        $row=mysqli_fetch_assoc($q1); 

        
        echo "<Tr>";
        echo "<td>".$row['date']."</td>";
        echo "<td>".$row['amount']."</td>";
        ?>
        <?php
      echo "</Tr>";

      }
      ?>
          
      </table>
<?php }?>
  <div style="padding-left:42%; padding-top:3%; font-size:20px; font-style: italic;"><?php echo @$err;?></div>
  </form>
<hr>
<form>
<hr>
  <h3 class="savings">Withdrawal Information</h3>

        
  <?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM withdrawtb WHERE memberId = '$memberId' ORDER BY date DESC ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;font-style: italic;font-size:20px'>No Withdrawal Data Available...</h2>";

      }
      else
      {
      ?>

              <table  id="membertb" >
        <tr>
          <th class="thead">Date</th>
          <th class="thead">Amount</th>
        </tr>
        <?php

      while($row=mysqli_fetch_assoc($q))
      {
        $q1=mysqli_query($con,"SELECT * FROM withdrawtb WHERE withdrawId='".$row['withdrawId']."' ");
        $row=mysqli_fetch_assoc($q1); 
        
        echo "<Tr>";
        echo "<td>".$row['date']."</td>";
        echo "<td>".$row['amountWithdrawn']."</td>";
        ?>
        <?php
      echo "</Tr>";

      }
      ?>
          
      </table>
<?php }?>
  <div style="padding-left:42%; padding-top:3%; font-size:20px"><?php echo @$err;?></div>

  </form>

<form>         

          <hr>
          
      </div>
      <div class="w3-container w3-card w3-white">
      <h3 class="savings">Loan Information</h3>
<?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM loantb WHERE memberId = '$memberId' ORDER BY dateTaken DESC ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;font-style: italic;font-size:20px'>No Loan Data Avalaible...</h2>";

      }
      else
      {
      ?>

              <table id="membertb" >
        <tr>
          <th class="thead">Date</th>
          <th class="thead">Amount</th>
          <th class="thead">Paid</th>
          <th class="thead">Balance</th>
        </tr>
        <?php

      while($row=mysqli_fetch_assoc($q))
      {
        // for displaying loan and date
        $q1=mysqli_query($con,"SELECT * FROM loantb WHERE loanId='".$row['loanId']."'");
        $row=mysqli_fetch_assoc($q1);  
        // for computing paid amount on a given loan
        $q2=mysqli_query($con,"SELECT SUM(amountPaid) AS paid FROM loanhist WHERE loanId='".$row['loanId']."' ");
        $r2=mysqli_fetch_assoc($q2);

        //query for displaying balance
      $q4=mysqli_query($con,"SELECT ROUND((SELECT (((loanInterest / 100) * loanAmount) + loanAmount) FROM loantb WHERE loanId='".$row['loanId']."') - (SELECT SUM(amountPaid) FROM loanhist WHERE loanId='".$row['loanId']."'), 2) AS balance ");
      $bal=mysqli_fetch_assoc($q4);


          echo "<Tr>";
          echo "<td>".$row['dateTaken']."</td>";
          echo "<td>".$row['loanAmount']."</td>";
          echo "<td>".$r2['paid']."</td>";
          echo "<td>".$bal['balance']."</td>";
          ?>
          <?php
        echo "</Tr>";

      }
      ?>
          
      </table>
<?php }?>

    <hr>

      </div>
    </div>
    <div style="padding-left:42%; padding-top:3%; font-size:20px"><?php echo @$err;?></div>


    <!-- End Right Column -->
    </div>
    </form>
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>
</div>

</body>
</html>
