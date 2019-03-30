<?php include("./includes/connect.inc.php");
session_start();
if (isset($_SESSION['user_login'])) {
$user=$_SESSION['user_login'];
}
else
{
$user="";
}
//Login form PHP Code
if (isset($_POST["user_login"])&& isset($_POST["password_login"])) {
$user_login= strip_tags(@$_POST['user_login']);
$password_login= strip_tags(@$_POST['password_login']);
$sql=mysql_query("SELECT * From users WHERE aadhar_id='$user_login' AND voter_id='$password_login'  LIMIT 1");//
//Check for existence
$user_count= mysql_num_rows($sql);
if ($user_count==1) {
while($row=mysql_fetch_array($sql)) {
$id=$row["id"];
}
$_SESSION["user_login"]=$user_login;
header("location:dashboard.php?profile_id=$id");
exit();
}
else
{
echo("<script>alert('The Information is Incorrect')</script>");
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Aadhar Login</title>
  <link rel="stylesheet" type="text/css" href="./css/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body class="text-center">
    <form class="form-signin" action="#" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Voter Login</h1>
      <label for="inputEmail" class="sr-only">Enter Your Aadhar Number</label>
      <input type="text" name="user_login" id="inputEmail" class="form-control" placeholder="Enter Your Aadhar Number" required autofocus>
      <label for="inputPassword" class="sr-only">Enter Your Voter ID</label>
      <input type="text" name="password_login" id="inputPassword" class="form-control" placeholder="Enter Your Voter ID" required>
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    </form>
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
