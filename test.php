<?php

    try {
        require "core/init.core.php";
        require "core/initVerwalung.core.php";
} catch (Exception $e) {
    echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
}
/*
if(isset($userVW)){
  if (!($userVW instanceof Nutzerverwaltung)){
    unset($userVW);
    $userVW = new Nutzerverwaltung();
  }
}else {
  $userVW = new Nutzerverwaltung();
}
echo getcwd() . "/core/FIle.php";*/
    if(isset($_POST['SubmitButton'])){ // Check if form was submitted
       #$userVW->adduser($username, $role, $email, $hashedpw);
        $message = var_dump($_POST);
        $hashedPW = password_hash($_POST['password'] , PASSWORD_DEFAULT);
    }
?>

<html>
    <body>
        <form action="#" method="post">
            <?php 
            echo '<pre>' , var_dump($files1) , '</pre>';
            echo '<br>';
            echo $message; 
            echo $hashedPW;    
            ?>
            PW
            <input type="password" name="password"/>
            Role:
            <input type="number" name="role"/>
            Name:
            <input type="text" name="name"/>
            Mail:
            <input type="email" name="email">
            <input type="submit" name="SubmitButton"/>
        </form>
    </body>
</html>
