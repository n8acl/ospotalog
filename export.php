<?php session_start();

include('/var/www/html/db_config.php');

$sql = "select os.contestcallsign, os.clubname, op.parkid, oc.classid, oc.power, os.cabrillo, os.contactname, os.contactaddress, os.contactcity, ";
$sql = $sql . "os.contactstate, os.contactzip, os.contactcountry, os.contactemail, os.operators from ospotasettings os ";
$sql = $sql . "join ospotaparks op on os.parkid = op.ospotaparkid ";
$sql = $sql . "join ospotaclass oc on os.classid = oc.ospotaclassid";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$contestcallsign = $row["contestcallsign"];
	$location = $row["parkid"];
	$clubname = $row["clubname"];
	$operators = $row["operators"];
	$entrycat = $row["classid"];
	$power = $row["power"];
	$cabrillo = $row["cabrillo"];
	$contactname = $row["contactname"];
	$contactaddress = $row["contactaddress"];
	$contactcity = $row["contactcity"];
	$contactstate = $row["contactstate"];
	$contactzip = $row["contactzip"];
	$contactcountry = $row["contactcountry"];
	$contactemail = $row["contactemail"];
}

$sql = "select count(contactid) as contactcnt from ospotalog";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$totalcontacts = $row["contactcnt"];
}

$sql = "select count(distinct parkid) as parkcnt from ospotalog where parkid <> 0";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	if ($row["parkcnt"] == 0) {
		$totalparks = 1;
	} else {
		$totalparks = $row["parkcnt"];
	}
}

if ($cabrillo == 1) {
	$bonuspoints = "25";
} else {
	$bonuspoints = "0";
}

$linefeed = "\n";
//$linefeed = "<br>";
$freq = array("80 M" => "3500", "40 M" => "7000", "20 M" => "1400", "15 M" => "2100", "10 M" => "2800");
$dir = "/var/www/html/";
$filename = $contestcallsign . ".log";

$txt = "START-OF-LOG: 3.0" . $linefeed;
$txt .=  "CREATED-BY: phpContestLogger - Jeff Lehman, N8ACL" . $linefeed;
$txt .=  "CALLSIGN: " . $contestcallsign . $linefeed;
$txt .=  "LOCATION: " . $location . $linefeed;
$txt .=  "CONTEST: OSPOTA" . $linefeed;
$txt .=  "CATEGORY-OPERATOR: " . $entrycat . $linefeed;
$txt .=  "CATEGORY-POWER: " . $power . $linefeed;
$txt .=  "OH-STATE-PARK: " . $location . $linefeed;
$txt .=  "CLUB-NAME: " . $clubname . $linefeed;
$txt .=  "CLAIMED-SCORE: " . $totalcontacts * ($totalparks + 1). $linefeed;
$txt .=  "CLAIMED-BONUS SCORE: " . $bonuspoints . $linefeed;
$txt .=  "NAME: " . $contactname . $linefeed;
$txt .=  "OPERATORS: " . $operators . $linefeed;
$txt .=  "ADDRESS: " . $contactaddress . $linefeed;
$txt .=  "ADDRESS-CITY: " . $contactcity . $linefeed;
$txt .=  "ADDRESS-STATE-PROVINCE: " . $contactstate . $linefeed;
$txt .=  "ADDRESS-POSTALCODE: " . $contactzip . $linefeed;
$txt .=  "ADDRESS-COUNTRY: " . $contactcountry . $linefeed;
$txt .=  "E-MAIL: " . $contactemail . $linefeed;
$txt .=  "SOAPBOX: Had a great time! Looking forward to next year!" . $linefeed;

$sql = "select ol.contactcallsign, sb.band, ifnull(op.parkid,0) as parkid, ifnull(ss.stateabrv,0) as stateabrv, ol.utc_datetime from ospotalog ol ";
$sql .= "join sysbands sb on sb.sysbandsid = ol.bandid ";
$sql .= "left join ospotaparks op on ol.parkid = op.ospotaparkid ";
$sql .= "left join sysstates ss on ss.sysstatesid = ol.stateid ";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$txt .=  "QSO: " . $freq[$row["band"]] . " PH " . date('Y-m-d',strtotime($row["utc_datetime"])) . " " . date('Hi',strtotime($row["utc_datetime"])) . " " . $contestcallsign . " ". $location. " " . $row["contactcallsign"] . " ";
	if ($row["stateabrv"] == "0") {
		$txt .=  $row["parkid"];
	} else {
		$txt .=  $row["stateabrv"];
	}
	$txt .=  $linefeed;
}

$txt .= "END-OF-LOG:" . $linefeed;

$myfile = fopen($dir . $filename, "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);

header("Content-Disposition: attachment; filename=\"". $filename . "\"");
header("Content-Type: application/log");
header("Content-Length: " . filesize($dir . $filename));
readfile($dir . $filename);
?>