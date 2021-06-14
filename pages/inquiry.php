<!DOCTYPE html>
<html lang="en">
<head>
<title><?php include('../admin/title.php');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body style="background-color:blanchedalmond">

<centre>
  <form class="modal-content1 animate1" method="POST" action="send_message.php" enctype = "multipart/form-data">

      <h1 class="login-text" style="text-align:center;margin-top:2%">Contact Admin</h1>
    
    <div class="container">
    <input type="date" id="announcementDate" class="form-control" style="text-align:center;margin-bottom:3%" name="dateComposed" readonly>
      <input type="text" class="form-control" placeholder="Your name" name="member" required><br />
      <input type="text" class="form-control" min="0" max="10" placeholder="Enter Phone Number" name="contact" required><br />
      <input type="text" class="form-control" placeholder="Subject" name="subject" required><br />
      <textarea type="text" class="form-control" placeholder="Type message" name="message" required></textarea><br />
    </div>

    <div class="container" style="background-color:#f1f1f1;text-align:center">
      <button class="signbtn" onclick="document.getElementById('id02').style.display='block'" style="width:auto">Send</button>
      <button type="button" onClick="location.href='../index.php'" class="cancelbtn">Back</button>
    </div>
  </form>
  </centre>
  <script>
var field = document.querySelector('#announcementDate');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>

<div class="bottom-nav">
<?php include('footer.php');?>
</div>
</body>
</html>