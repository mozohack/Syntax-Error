<?php
include('../includes/connect.inc.php');
session_start();
if (isset($_SESSION['user_login'])) {
$log_user_name=$_SESSION['user_login'];
$coverpicposts=mysql_query("SELECT * FROM admin WHERE email='$log_user_name'") or die (mysql_error);
while($row = mysql_fetch_assoc($coverpicposts)) {
$user=$row['id'];
}
}
else
{
$user="";
}
if ($user==""){
  die("ERROR");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <a class="navbar-brand" href="#">Admin Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin-dashboard.php">Show Results </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="verifyusers.php">Verify <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container" style="margin-top:20px;">
  <?php 
  $user_id=$_GET['id'];
  $sql=mysql_query("SELECT * FROM users WHERE id='$user_id'");
    while($row=mysql_fetch_array($sql)){
      $id=$row['id'];
      $aadhar_id=$row['aadhar_id'];
      $voter_id=$row['voter_id'];
      $name=$row['name'];
      $picture=$row['picture'];
      $verpic=$row['ver_pic'];

      echo'
      <div class="row">
        <div class="col-md-3">
        <h2  class="display-4" style="font-size:30px">Picture In Database</h2>
        <hr>
          <img src="../images/'.$picture.'" style="width:100%">
        </div>
        <div class="col-md-3">
         <h2 class="display-4" style="font-size:30px">Current Picture</h2>
         <hr>
          <img src="../uploads/'.$verpic.'" style="width:100%">
        </div>
        
      ';
    }

  ?>
  <?php
  $verify=@$_POST['verify'];
  $reject=@$_POST['reject'];
  if($verify){
    mysql_query("UPDATE users SET ver_status='verified' WHERE id='$user_id'");
    echo'
      <script>alert("verified")</script>
    ';
    header("location:verifyusers.php");
  }
  if($reject){
    mysql_query("UPDATE users SET ver_status='' WHERE id='$user_id'");
    echo'<script>alert("rejected");</script>';
    header("location:verifyusers.php");
  }
  ?>
  <div class="col-md-3">
    <form action="#" method="post">
    <input type="submit" name="verify" class="btn btn-success" value="Verify">
    <input type="submit" name="reject" class="btn btn-danger" value="Reject">
    </form>
  </div>
</div>
</table>
  <!-- <center><iframe src="http://localhost:3000/results.html" height="500" width="1000" style=""></iframe></center> -->
</div>
</body>
</html>