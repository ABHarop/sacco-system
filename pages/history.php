<?php session_start();
if(empty($_SESSION['memberId'])):
header('Location:../index.php');
endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php include('../admin/title.php');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body class="body">
<?php include('header.php');?>
<?php
include('db.php');

$memberId=$_SESSION['memberId'];
$sql=mysqli_query($con,"SELECT * FROM historytb  WHERE memberId='$memberId'");
$res=mysqli_fetch_array($sql);
//print_r($res);
?>
<center>
<div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="status">HISTORY LOG</h2>

      <div class="w3-container w3-card w3-white">

<?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM historytb  WHERE memberId = '$memberId' ORDER BY schedule DESC ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;'>No history log...</h2>";

      }
      else
      {
      ?>

              <table class="w3-table-all"  id="membertb" >
        <tr>
            <th class="thead">HID</th>
          <th class="thead">Activity Log</th>
          <th class="thead">Date/Time</th>
        </tr>
        <?php

      while($row=mysqli_fetch_assoc($q))
      {

        $q1=mysqli_query($con,"SELECT * FROM historytb  WHERE historyId='".$row['historyId']."' ");
        $row=mysqli_fetch_assoc($q1); 
        
        echo "<Tr>";
        echo "<td>".$row['historyId']."</td>";
        echo "<td>".$row['activity']."</td>";
        echo "<td>".$row['schedule']."</td>";
        ?>
        <?php
      echo "</Tr>";

      }
      ?>
          
      </table>
<?php }?>
  <div style="padding-left:42%; padding-top:3%; font-size:20px"><?php echo @$err;?></div>
  </div>
  </div>
  </center>
  <div class="bottom-nav">
<?php include('footer.php');?>
</div>

      <script>
var field = document.querySelector('#joinDate');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>