<?php
    require 'nutzerverwaltung.class.php';
    $h = new Nutzerverwaltung();

    if(isset($_POST['SubmitButton'])){ // Check if form was submitted
        $hashedPW = password_hash($_POST['password'] , PASSWORD_DEFAULT);
        echo $h->adduser($_POST['username'], $_POST['role'], $_POST['email'], $hashedPW);
        $message = var_dump($_POST);
        $h->getStatus();
    }

?>

<html>
    <body>
        <form action="#" method="post">
            <?php

            #echo '<pre>' , var_dump($files1) , '</pre>';
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

