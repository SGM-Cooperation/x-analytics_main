<?
require "core\autoload.core.php";
    require "core\initVerwalung.core.php";
    global $productVW;
	<h1> User </h1>
  <form acticon="test.php" method="POST">
    <input type="text" name="username">
    <input type="number" name="role">
    <input type="email" name="email">
    <input type="password" name=password>
  </form>
  $nutzerVW->adduser($_POST['username'], $_POST['role'], $_POST['email'], password_hash($_POST['password']))
?>
