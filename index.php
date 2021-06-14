
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php include('admin/title.php');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<video autoplay muted loop id="myVideo">
  <source src="pages/rain.mp4" type="video/mp4">
</video>
<div class="content">
<!-- Code that displays the login option -->

<div class="login">
        <h1 style="color: blanchedalmond; font-size:35px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Login</h1>
        <form action="login.php" method="post">
            <label style="background-color:rgba(7, 66, 58, 0.733);font-weight:lighter" for="contact">
					<I class="fas fa-user"></i>
				</label>
            <input type="text" name="contact" placeholder="Phone Number" id="contact" required>
            <label style="background-color:rgba(7, 66, 58, 0.733);font-weight:lighter" for="password">
					<I class="fas fa-lock"></i>
        </label>
            <input type="password" name="password" placeholder="Password" id="password" required>

            <label style="width:auto;background-color:transparent;color:blanchedalmod"><input type="checkbox" onclick="showPassword()">Show Password</label>

            <input type="submit" style="background-color:rgba(7, 66, 58, 0.733);font-weight:lighter" value="Login">
        </form>
        <i><p class="text">Forgot password? Click <button class="login-btn" onclick="document.getElementById('id02').style.display='block'" style="fore-color:blanchedalmod;width:auto;background:transparent">here...</button></p></i>
        <i><p class="text">For inquiries, click <a href="pages/inquiry.php" style="color:blanchedalmond;margin-bttom:2%">here...</a> </p></i>
    </div>
    <i><p class="text">&copy Copyright 2020</p></i>
</div>

<!-- Registering for an account -->
<div id="id02" class="modal1">
<centre>
  <form class="modal-content1 animate1" method="POST" action="pages/recover_password.php" onsubmit="return passwordMatch()" enctype = "multipart/form-data">
    <div class="imgcontainer">
      
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      
    </div>
      <h1 class="login-text" style="text-align:center">Account Recovery</h1>
    
    <div class="container">
      <input class="form-control" placeholder="Enter Phone Number" name="contact" required><br />
      <input class="form-control" id="newpassword" name="newpassword" type="password" placeholder="Type new password" required ><br />
      <input class="form-control" id="cfmPassword" type="password" name="newpassword" placeholder="Reenter new password" required ><br />

    </div>
    <div style="text-align:center">
    <label>Enter phone number used when registering the account<br/>If you are not sure, kindly contact admin<a href="pages/inquiry.php" style="color:dodgerblue"><H6>here</H6></a>.</label>
    </div>
    <div class="container" style="background-color:#f1f1f1;text-align:center">
      <button class="signbtn" type="submit" value="Submit" onclick="document.getElementById('id02').style.display='block'" style="width:auto">Submit</button>
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>

  </form>
  </centre>
</div>
<script>
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
	</script>
  <script>
var field = document.querySelector('#joinDate');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>
<script>
function passwordMatch() {
    var pass1 = document.getElementById("newpassword").value;
    var pass2 = document.getElementById("cfmPassword").value;
    var ok = true;
    if (pass1 != pass2) {
        alert("Passwords Do not match");
        document.getElementById("password").style.borderColor = "#E34234";
        document.getElementById("cfmPassword").style.borderColor = "#E34234";
        ok = false;
    }
    else {
        alert("Save Changes?");
    }
    return ok;
}
	</script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


