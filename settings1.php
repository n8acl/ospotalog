<?php session_start();

#include('/var/www/html/db_config.php');
include('db_config.php');

if ($_POST["function"] == "Update") {
	$sql = "update ospotasettings set ";
	$sql = $sql . "contestcallsign = '" . $_POST["contestcallsign"] . "', ";
	$sql = $sql . "clubname = '" . $_POST["clubname"] . "', ";
	$sql = $sql . "parkid = " . $_POST["location"] . ", ";
	$sql = $sql . "licenseclassid = " . $_POST["licenseclass"] . ", ";
	$sql = $sql . "operators = '" . $_POST["operators"] . "', ";
	$sql = $sql . "contactname = '" . $_POST["contactname"] . "', ";
	$sql = $sql . "contactaddress = '" . $_POST["contactaddress"] . "', ";
	$sql = $sql . "contactcity = '" . $_POST["contactcity"] . "', ";
	$sql = $sql . "contactstate = '" . $_POST["contactstate"] . "', ";
	$sql = $sql . "contactzip = '" . $_POST["contactzip"] . "', ";
	$sql = $sql . "contactcountry = '" . $_POST["contactcountry"] . "', ";
	$sql = $sql . "contactemail = '" . $_POST["contactemail"] . "', ";
	$sql = $sql . "cabrillo = '" . $_POST["cabrillo"] . "'";
	$conn->query($sql);

	$_SESSION["settingsupdated"] = 1;
} else {
	$_SESSION["settingsupdated"] = 0;
}

header("location: settings.php");

?>