<?php
    if(isset($_POST['SubmitButton'])){ // Check if form was submitted
       
        $message = var_dump($_POST);
    }
?>

<html>
    <body>
        <form action="#" method="post">
            <?php echo $message; ?>
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
