<html>
<body>
<?
function Connect($host = localhost,$user = "root",$pass = "",$DB = "demo"){
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
  $link = mysqli_connect($host, $user, $pass, $DB);

  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
}

function InsertValue($Value, Muster = [IP, Country, City, Time, Page]){
  $sql = "INSERT INTO persons ($Muster) VALUES ($Value)";
  echo $sql;
}

InsertValue(["192,168.2.1", "DE", "LOE", "12:00", "Main"]);
?>
  </body>
</html>
