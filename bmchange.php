<?php session_start();

$_SESSION["band"] = $_POST["band"];

header("location: index.php");

?>