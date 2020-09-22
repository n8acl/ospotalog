<?php session_start();

#include('/var/www/html/db_config.php');
include('db_config.php');

if ($_POST["log"] == "Check Dupe") {
	$sql = "select count(ol.contactcallsign) as cntcallsign from ospotalog ol ";
	$sql .= "join sysbands b on ol.bandid = b.sysbandsid ";
	$sql .= "where contactcallsign = '" . strtoupper($_POST["callsign"]) . "' ";
	$sql .= "and trim(b.band) = '" . strtoupper($_SESSION["band"]) . "'";

    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
    	$cntcallsign = $row["cntcallsign"];
    }
    
    
    if ($cntcallsign > 0) {
        $_SESSION["dupecheck"] = 0;
        header("location: index.php");
        exit();
    } else {
        $_SESSION["dupecheck"] = 1;
        $_SESSION["callsign"] = strtoupper($_POST["callsign"]); 
        $_SESSION["parkid"] = strtoupper($_POST["parkid"]);
        $_SESSION["stdx"] = strtoupper($_POST["stdx"]);
        header("location: index.php");
        exit();
           
    }
}

if ($_POST["log"] == "Clear") {
    $_SESSION["callsign"] = ''; 
	$_SESSION["parkid"] = '';
	$_SESSION["stdx"] = '';
	$_SESSION["dupecheck"] = 2;
	header("location: index.php");
	exit();
}

$sql = "select count(ol.contactcallsign) as cntcallsign from ospotalog ol ";
$sql .= "join sysbands b on ol.bandid = b.sysbandsid ";
$sql .= "where contactcallsign = '" . strtoupper($_POST["callsign"]) . "' ";
$sql .= "and trim(b.band) = '" . strtoupper($_SESSION["band"]) . "'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$cntcallsign = $row["cntcallsign"];
}

if ($cntcallsign > 0) {
    $_SESSION["dupecheck"] = 3;
    header("location: index.php");
    exit();
} 

$sql = "select licenseclassid from ospotasettings";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$licenseclassid = $row["licenseclassid"];
}

if ($_POST["parkid"] == "") {
	$parkid = 76;
} else {
	$sql = "select ospotaparkid from ospotaparks where parkid = '" . strtoupper($_POST["parkid"]) . "'";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$parkid = $row["ospotaparkid"];
	}
}

if ($_POST["stdx"] == "") {
	$stateid = 52;
} else {
	$sql = "select sysstatesid from sysstates where stateabrv = '" . strtoupper($_POST["stdx"]) . "'";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$stateid = $row["sysstatesid"];
	}
}

$sql = "select sysbandsid from sysbands where band = '" . $_SESSION["band"] . "' and licenseclassid = " . $licenseclassid . " and mode =1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$sysbandsid = $row["sysbandsid"];
}
	$sql = "insert into ospotalog (contactcallsign, parkid, stateid, utc_datetime, mode, bandid) ";
	$sql = $sql . "values(";
	$sql = $sql . "'" . strtoupper($_POST["callsign"]) . "',";
	$sql = $sql . $parkid . ",";
	$sql = $sql . $stateid . ",";
	$sql = $sql . "'" . gmdate("Y-m-d H:i:s") . "',";
	$sql = $sql . "1,";
	$sql = $sql . $sysbandsid;
	$sql = $sql . ")";
	$conn->query($sql);

$_SESSION["callsign"] = ''; 
$_SESSION["parkid"] = '';
$_SESSION["stdx"] = '';
$_SESSION["dupecheck"] = 2;

header("location: index.php");

?>