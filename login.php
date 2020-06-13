<!DOCTYPE html>
<html>
<?php
#error_reporting(0);
require "classes/nutzerverwaltung.class.php";
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Milano Online Shop</title>
    <meta property="og:image" content="assets/img/Title.png?h=ed098f1e3bcf24f3d2d21c542f44e3f5">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=36611ed837078aa120f31b2824b86d8d">
</head>
<?php
function redirect($url, $statusCode = 303)
{
  echo "Start der Umleitung";
   header('Location: ' . $url, true, $statusCode);
   die();
}
$Path = $_SERVER['SERVER_NAME'];
if(isset($_SERVER[HTTPS])){

}else{
    $Path = "http://$Path";
}
function checkUser($EMail, $PW){
  global $userVW;
  echo "<br/>";
    printf("not accepted now");
    echo "<br/>";
    if($userVW->check_user($EMail, $PW)){
      printf("accepted");
      $_SESSION['login'] = true;
      $_SESSION['Role'] =  $userVW->get_userrole_by_id($userVW->get_userid_by_name($EMail));
  }
}
$Path = $_SERVER['SERVER_NAME'];
if(isset($_SERVER[HTTPS])){

}else{
    $Path = "http://$Path";
}

?>
<body style="background-image: url('assets/img/Dashbord/background.jpg')">
    <!-- Start: Login Form Dark -->
    <div class="login-dark">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2 class="sr-only">Login Form</h2>
            <input name="post" value="true" style="opacity: 0;" checked>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Login</button><!--</div><a class="forgot" href="#">Forgot your email or password?</a>--></form>
    </div>
    <!-- End: Login Form Dark -->

    <?php

if($_POST['post'] == "true"){
  $_POST['post'] = "false";
  checkUser($_POST['email'],$_POST['password']);
  echo "<br/>";
  var_dump($_SESSION['login']);
  printf("Session Var:");
  var_dump(session_id());
  echo "<br/>";
}

if(isset($_SESSION['login'])){
  if($_SESSION['login']){
    redirect("$Path/Dashbord.php");
  }
}
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=9a96c264514f52ccce2a2d2c659647a3"></script>
</body>

</html>
