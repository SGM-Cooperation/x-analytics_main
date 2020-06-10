<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Cookie.js"></script>
<meta http-equiv="refresh" content="5>
<?php

    require "core\autoload.core.php";
    require "core\initVerwalung.core.php";
    global $productVW;

    session_start();
    $_SESSION['Page'] =  '<script> document.write(checkCookie("Page", window.location.href)); </script>';
    $_SESSION['Time'] =  '<script> document.write(RoundCorrect((getCookie("End") - checkCookie("Start", new Date().getTime()) ) / 1000 /60) + " Min"); </script>';
    $_SESSION['IP'] = '<script> document.write(checkCookie("IP", json.ip)); </script>';
    if($_SESSION['Country']!= NULL)
    {
        '<script> locationIP(); </script>';
    }else {
        $_SESSION['IP'] = '<script> document.write(getCookie("City")); </script>;';
        $_SESSION['Contry'] = '<script> document.write(getCookie("Country")); </script>';
    }
    $_SESSION['Browser'] = '<script> document.write(checkCookie("Browser", detect.parse(navigator.userAgent).browser.name)); </script>';


    function redirect($url, $statusCode = 303)
    {

        header('Location: ' . $url, true, $statusCode);
        die();
    }

    //Past initialisation
    $Path = $_SERVER['SERVER_NAME'];
    if(!(isset($_SERVER[HTTPS]))) {
        $Path = "http:/$Path";
    }
    $Path = "$Path/login";

    function addCookie($IP, $City, $Country, $Time, $Browser, $ID_Page)
    {
        global $Path;
        global $productVW;
        $productVW->add_cookie($IP, $City, $Country, $Time, $Browser, $ID_Page);
        $_SESSION['add'] = NULL;
        redirect($Path);
    }
    function updateCookie($URL, $IP, $Time){
        global $Path;
        global $productVW;
        $productVW->update_Cookie($productVW->get_Cookie_ID($URL, $IP), $Time);
    }
    if(!($_SESSION['IP'] == NULL)){
        updateCookie($_SESSION['Page'], $_SESSION['IP'], $_SESSION['Time']);
    }else{
        addCookie($_SESSION['IP'], $_SESSION['City'], $_SESSION['Country'], $_SESSION['Time'], $_SESSION['Browser'], $productVW->get_Page_by_URL($_SESSION['Page']));
    }
?>
