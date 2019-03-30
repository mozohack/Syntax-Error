<?php
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect("localhost","root","")or die("Connnection Error");
mysql_select_db("mozo")or die("Database Error")
?>
<?php
// define('SITE_KEY', '6LddDZsUAAAAAN_RXFwq0wPZAN_669Tl-2eDhASp');
// define('SECRET_KEY', '6LddDZsUAAAAAOpZg8OwrnHz9q5P1iis4ElDcVq5');

// if($_POST){
//     function getCaptcha($SecretKey){
//         $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
//         $Return = json_decode($Response);
//         return $Return;
//     }
//     $Return = getCaptcha($_POST['g-recaptcha-response']);
//     var_dump($Return);
//     if($Return->success == true && $Return->score > 0.5){
//         echo "<script>console.log('success')</script>";
//     }else{
//         echo'<script>console.log("bot")</script>';
//         die('Error...Something went wrong');
//     }
// }

?>

<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
</head>
<body>
<form action="#" method="POST"> -->
        <!-- <input type="text" name="name" /><br /> -->
        <!-- <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br > -->
        <!-- <input type="submit" value="Submit" /> -->
    <!-- </form> -->
<!-- </body>
</html>
<script>
    grecaptcha.ready(function() {
    grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
    .then(function(token) {
        console.log(token);
        document.getElementById('g-recaptcha-response').value=token;
    });
    });
    </script>  -->