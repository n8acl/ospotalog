<?php session_start();

include('/var/www/html/db_config.php');

if ($_POST["deletedata"] == "YES"){
   $sql = "delete from ospotalog";
   $conn->query($sql);
	   
   $sql = "ALTER TABLE ospotalog AUTO_INCREMENT = 1";
   $conn->query($sql);
		   
   header("location: index.php");
} else {
	header("location: index.php");
}

?>