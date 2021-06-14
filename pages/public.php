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
$sql=mysqli_query($con,"SELECT * FROM membertb WHERE memberId='$memberId'");
$res=mysqli_fetch_array($sql);
//print_r($res);
?>

<center>
<div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="status">PUBLIC MESSAGES</h2>

      <div class="w3-container w3-card w3-white">

<?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM publicmessagetb ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;'>No public announcement received...</h2>";

      }
      else
      {
      ?>

              <table class="w3-table-all"  id="membertb" >
        <tr>
            <th class="thead">Administrator</th>
          <th class="thead">Date</th>
          <th class="thead">Message</th>
        </tr>
        <?php

      while($row=mysqli_fetch_assoc($q))
      {

        $q1=mysqli_query($con,"SELECT * FROM publicmessagetb WHERE pid='".$row['pid']."'");
        $row=mysqli_fetch_assoc($q1); 

        $sql=mysqli_query($con,"SELECT * FROM admintb WHERE adminId='".$row['adminId']."'");
        $res=mysqli_fetch_array($sql);
        
        echo "<Tr>";
        echo "<td>".$res['admin_name']."</td>";
        echo "<td>".$row['dateComposed']."</td>";
        echo "<td>".$row['messageBody']."</td>";
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
</div>
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