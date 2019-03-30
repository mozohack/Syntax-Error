<?php
include('./includes/connect.inc.php');
session_start();
if (isset($_SESSION['user_login'])) {
$log_user_name=$_SESSION['user_login'];
$coverpicposts=mysql_query("SELECT * FROM users WHERE aadhar_id='$log_user_name'") or die (mysql_error);
while($row = mysql_fetch_assoc($coverpicposts)) {
$user=$row['id'];
$aadhar_id=$row['aadhar_id'];
$voter_id=$row['voter_id'];
$dob=$row['dob'];
$father_name=$row['father_name'];
$name=$row['name'];
$district=$row['district'];
$constituency=$row['constituency'];
$is_voted=$row['is_voted'];
$picture=$row['picture'];
}
}
else
{
$user="";
}
if ($user==""){
  die("ERROR");
}

//modal validation
$verify=@$_POST['verify'];
$vername=@$_POST['ver-name'];
$verdob=@$_POST['ver-dob'];
if($verify){
	if($verdob&&$vername){
		if($verdob==$dob && $vername==$name){
			header("location:verifypic.php");
		}
		else{
			// header('location:fail.php');
		}
	}
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Voter Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">How to use ?</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Help</a>
          <a class="dropdown-item" href="#">FAQ</a>
          <a class="dropdown-item" href="#">Contact Us</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="container" style="margin-top:20px">
	<div class="row">
		<div class="col-md-3">
			<div id="details">
				<img src="./images/<?php echo $picture;?>" style="width:100%">
				<hr>
				<?php
					if($is_voted=='false'){
						echo '<button class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModal">Procced To Vote</button>';
					}
					else{
						echo'<button class="btn btn-danger btn-block" disabled>Already Voted</button>';
					}
				?>
				
			</div>
		</div>
		<div class="col-md-6">
			<h1 class="display-4" style="font-size:40px"><?php echo $name;?></h1>
			<hr>
			<p><span>Name : </span><?php echo $name;?></p>
			<p><span>Aadhar ID : </span><?php echo $aadhar_id;?></p>
			<p><span>Voter ID : </span><?php echo $voter_id;?></p>
			<p><span>DOB : </span><?php echo $dob;?></p>
			<p><span>Father Name : </span><?php echo $father_name;?></p>
			<p><span>District : </span><?php echo $district;?></p>
			<p><span>Constituency : </span><?php echo $constituency;?></p>
		</div>
	</div>
</div>

<!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Your Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
        	<input type="text" class="form-control" placeholder="Enter Your Name" name="ver-name">
        	<input type="text" class="form-control" placeholder="Enter Your DOB" name="ver-dob" style="margin-top:20px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="verify" value="Verify">
      </div>
  </form>
    </div>
  </div>
</div>
</body>
</html>