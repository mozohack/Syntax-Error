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
<!-- Captcha -->
<?php
define('SITE_KEY', '6LddDZsUAAAAAN_RXFwq0wPZAN_669Tl-2eDhASp');
define('SECRET_KEY', '6LddDZsUAAAAAOpZg8OwrnHz9q5P1iis4ElDcVq5');

if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
        echo "<script>console.log('success')</script>";
    }else{
        echo'<script>console.log("bot")</script>';
        die('Error...Something went wrong');
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
    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>

</head>
<body class="text-center">
  <div class="container" style="margin-left:250px;">
    <form class="form-signin" action="#" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Voter Login</h1><hr>
      <label for="inputEmail" class="sr-only">Enter Your Aadhar Number</label>
      <input type="text" name="user_login" id="inputEmail" class="form-control" placeholder="Enter Your Aadhar Number" required autofocus>
      <input type="hidden"id="g-recaptcha-response" name="g-recaptcha-response" ><br >
      <label for="inputPassword" class="sr-only">Enter Your Voter ID</label>
      <input type="text" name="password_login" id="inputPassword" class="form-control" placeholder="Enter Your Voter ID" required>
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    </form>
  </div>
    <hr>
    <!-- <form action="#" method="POST">
        <input type="text" name="name" /><br />
        
        <input type="submit" value="Submit" />
    </form> -->
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
    .then(function(token) {
        // console.log(token);
        document.getElementById('g-recaptcha-response').value=token;
    });
    });
    </script>