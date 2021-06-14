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
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="bootsrap/css/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
<?php include('db.php');?>
<h2 class="page-title">PERSONAL MESSAGES</h2>
<form method="POST">
<?php
$sql=mysqli_query($con,"SELECT * FROM membertb WHERE memberId='".$_GET['memberId']."'");
$res=mysqli_fetch_array($sql);
?>
<input class="searchbox" style=" width:auto;color:black; font-weight:lighter; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:25px; border: 0px solid #ccc; background-color:blanchedalmond; font-style:italic" value="<?php echo $res['member_name']; ?>" name="member_name" readonly>
</form>

<button style=" background-color:black; color:blanchedalmond" class="add-btn" onClick="document.getElementById('id01').style.display='block'" style="width:auto" >Compose</button>

<button style="margin-left:2px;color:blanchedalmond;background-color:#f44336" class="add-btn"  onClick="location.href='member.php'" >Back</button>
<?php 
$q=mysqli_query($con,"SELECT * FROM messagetb WHERE memberId='".$_GET['memberId']."' ");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red; padding-left:230px'>No message from this member...</h2>";

}
else
{
?>

<table class="w3-table-all"  id="membertb" >
  <tr>
    <th>Sender</th>
    <th>Date</th>
    <th>Message</th>
  </tr>

<?php

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 50;
  $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `messagetb`");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
  $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

  $result = mysqli_query($con,"SELECT * FROM `messagetb` WHERE memberId='".$_GET['memberId']."' LIMIT $offset, $total_records_per_page");
  while($row = mysqli_fetch_array($result)){

$q1=mysqli_query($con,"SELECT * FROM messagetb WHERE messageId='".$row['messageId']."' ");
$r1=mysqli_fetch_assoc($q1);


echo "<Tr>";

echo "<td>".$r1['sender']."</td>";
echo "<td>".$r1['dateComposed']."</td>";
echo "<td>".$r1['messageBody']."</td>";

?>

<?php 
echo "</Tr>";


}
		

//for showing Pagination


		?>
		
</table>
<div>
<strong class="pageno">Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
<?php }?>
  
</div>


<!-- Code for composing message -->
<div id="id01" class="modal1">
  
  <form class="modal-content1 animate1" action = "compose_message.php" method = "POST" enctype = "multipart/form-data">
    <div class="imgcontainer">
      <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

      <h3 class="modal-title">New Message</h3>
    </div>
    <div class="container-register">
    <label class="label">Date</label>
   <input type="date" id="composeDate" class="date" style="text-align:center" name="dateComposed" readonly>
    <label class="label">Name</label>
    <select name="memberId" class="fill-in" required>
			<option value="">Select Recipient</option>
			<?php 
            $q1=mysqli_query($con,"SELECT * FROM membertb WHERE status='Active' ");
            while($r1=mysqli_fetch_assoc($q1))
               {
               echo "<option value='".$r1['memberId']."'>".$r1['member_name']."</option>";
               }
			?>
		</select><br />
      <label class="label">Message</label>
      <input class="fill-in" placeholder="Type Message" name="messageBody" required>
</div>
<center>
   <div class="container" style="background-color:#f1f1f1">
   <button class="signbtn" onclick="document.getElementById('id01').style.display='block'" style="width:auto">Send</button>
   <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
</center>
  </form>
  
</div>


</div>
</div>
<script>
var field = document.querySelector('#composeDate');
var date = new Date();
//set date
field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);

</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>