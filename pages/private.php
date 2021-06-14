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
<style>
.form-control {
  display: block;
  width: 100%;
  font-family: Verdana, sans-serif;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.35rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
  .form-control {
    transition: none;
  }
}

.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}

.form-control:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #495057;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-control::-webkit-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::-moz-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control:-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control:disabled, .form-control[readonly] {
  background-color: #e9ecef;
  opacity: 1;
}

select.form-control:focus::-ms-value {
  color: #495057;
  background-color: #fff;
}
textarea.form-control {
  height: auto;
  resize:none;
  font-weight:lighter;
  width: 100%;
  font-size:14px"
}
.form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
  }
}
</style>
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
        <h2 class="status">PRIVATE MESSAGES</h2>
        <i> <button style="background-color:maroon;width:auto;padding:9px" onclick="document.getElementById('id02').style.display='block'" style="">Contact Admin</button></i>

      <div class="w3-container w3-card w3-white">

<?php 
      $memberId=$_SESSION['memberId'];
      $q=mysqli_query($con,"SELECT * FROM messagetb WHERE memberId = '$memberId' ");
      $rr=mysqli_num_rows($q);
      if(!$rr)
      {
      echo "<h2 style='color:red;'>No message received...</h2>";

      }
      else
      {
      ?>

              <table class="w3-table-all"  id="membertb" >
        <tr>
            <th class="thead">Sender</th>
          <th class="thead">Date</th>
          <th class="thead">Message</th>
        </tr>
        <?php

      while($row=mysqli_fetch_assoc($q))
      {

        $q1=mysqli_query($con,"SELECT * FROM messagetb  WHERE messageId='".$row['messageId']."' ");
        $row=mysqli_fetch_assoc($q1); 
        
        echo "<Tr>";
        echo "<td>".$row['sender']."</td>";
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
  </center>
<?php
  $memberId=$_SESSION['memberId'];
$sql=mysqli_query($con,"SELECT * FROM membertb WHERE memberId='$memberId'");
$res=mysqli_fetch_array($sql);
//print_r($res);
?>

<!-- Contact admin -->
<div id="id02" class="modal1">
<centre>
  <form class="modal-content1 animate1" method="POST" action="compose_message.php" enctype = "multipart/form-data">
    <div class="imgcontainer">
      
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      
    </div>
      <h1 class="login-text" style="text-align:center">Contact Admin</h1>
    
    <div class="container">
    <input  style="text-align:center;margin-top:2%" value="<?php echo $res['memberId'];?>" name="memberId" readonly hidden><br />
      <input type="date" class="form-control" style="text-align:center" type="date" id="joinDate" name="dateComposed" readonly><br />
      <textarea type="text" class="form-control" placeholder="Type message here..." name="messageBody" required></textarea><br />
    </div>

    <div class="container" style="background-color:#f1f1f1;text-align:center">
      <button class="signbtn" onclick="document.getElementById('id02').style.display='block'" style="width:auto">Send</button>
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
  </centre>
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