<?php session_start();

include('/var/www/html/db_config.php');

$sql = "select count(fdbonusid) as fdbonusidcnt from fdbonuslist";
$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
	$totalbonusid = $row["fdbonusidcnt"];
}

for ($x=1; $x <= $totalbonusid; $x++){
	if (in_array($x,$_POST["bonuspt"])){
		$sql="update fdbonuslist set claimed = 1, qualifier = 1 where fdbonusid = ". $x;
		$conn->query($sql);
	} else {
		$sql="update fdbonuslist set claimed = 0, qualifier = 0 where fdbonusid = ". $x;
		$conn->query($sql);
	}
	
	if ($x == 7) {
		$sql="update fdbonuslist set qualifier = " . intval($_POST["qualifier7"]) . " where fdbonusid = ". $x;
		$conn->query($sql);
	}
	if ($x == 13) {
		$sql="update fdbonuslist set qualifier = " . intval($_POST["qualifier13"]) . " where fdbonusid = ". $x;
		$conn->query($sql);
	}

}





/* if ($_POST["function"] == "Update") {
	$sql = "update fdbonuslist set ";
	if 
	$sql = $sql . "contestcallsign = '" . $_POST["contestcallsign"] . "', ";
	$sql = $sql . "clubname = '" . $_POST["clubname"] . "', ";
	$sql = $sql . "licenseclassid = " . $_POST["licenseclass"] . ", ";
	$sql = $sql . "fdclassid = '" . $_POST["fielddayclass"] . "', ";
	$sql = $sql . "fdpowerid = '" . $_POST["power"] . "', ";
	$sql = $sql . "fdsectionid = '" . $_POST["section"] . "', ";
	$sql = $sql . "numtrans = '" . $_POST["numtrans"] . "', ";
	$sql = $sql . "numparticipants = '" . $_POST["numparticipants"] . "', ";
	$sql = $sql . "gotacallsign = '" . $_POST["gotacallsign"] . "'";

	$conn->query($sql);

	$_SESSION["settingsupdated"] = 1;
} else {
	$_SESSION["settingsupdated"] = 0;
} */

header("location: fdsettings.php");

?>