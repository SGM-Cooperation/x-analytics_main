<?
require "core\autoload.core.php";
    require "core\initVerwalung.core.php";
    global $userVW ;
?>
	<h1> User </h1>
		
  <form acticon="/test.php" method="post">
    <input type="text" name="username">
    <input type="number" name="role">
    <input type="email" name="email">
    <input type="password" name=password>
		
    <button type="submit" name="action" value="0">Submit</button>
  </form>
<?
  var_dump($_POST)
  $userVW->adduser($_POST['username'], $_POST['role'], $_POST['email'], password_hash($_POST['password']))
?>
