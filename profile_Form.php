<?php
	require "core\autoload.core.php";
    require "core\initVerwalung.core.php";
    global $productVW;
	
	if($_POST['changeWebseite']){
		$productVW->update_Page($productVW->get_Page_by_URL($_POST['oldURL']), $_POST['URL');
	}
	if($_POST['changeUser']){
		$nutzerVW->changeUser($_POST['username'], $_POST['email'], $_POST['name']);
	}
?>