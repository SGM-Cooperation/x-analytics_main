<?php
    if(isset($_POST['SubmitButton'])){ // Check if form was submitted

        $input = $_POST['inputText']; // Get input text
        $message = "Success! You entered: " . $input;
    }
?>

<html>
    <body>
        <form action="#" method="post">
            <?php echo $message; ?>
            <input type="text" name="inputText"/>
            <input type="submit" name="SubmitButton"/>
        </form>
    </body>
</html>
