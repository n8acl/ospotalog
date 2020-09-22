<?php session_start();

$sql = "select count(contactid) as contactcnt from ospotalog";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$totalcontacts = $row["contactcnt"];
}

$sql = "select count(distinct parkid) as parkcnt from ospotalog where parkid <> 76";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	if ($row["parkcnt"] == 0) {
		$totalparks = 0;
	} else {
		$totalparks = $row["parkcnt"];
	}
}

$sql = "select count(distinct stateid) as statecnt from ospotalog where stateid <> 52";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$totalstates = $row["statecnt"];
}

$sql = "select cabrillo from ospotasettings";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$submittedcabrillo = $row["cabrillo"];
}

	echo "<b>Current Statistics</b><br>";
	echo "<table border = 1 cellpadding = 15>";
		echo "<tr><td>";

		echo "<b>Total Contacts: </b>" . $totalcontacts;
		echo "<br>";
		
		echo "<b>Total Parks Worked: </b> " . $totalparks . "<br>";
		echo "<b>Total States/DX Worked: </b> " . $totalstates;
		echo "<br><br>";

		
		echo "<b>Current QSO Score:</b> " . $totalcontacts . "<br>";		
		echo "<b>Current Multiplier Points:</b> ". $totalparks . "<br>";
		echo "<b>Cabrillo Submission?:</b> ";
		switch ($submittedcabrillo){
			case 1:
				$bonuspoints = 25;
				break;
			default:
				$bonuspoints = 0;
				break;
		}
		echo $bonuspoints;
		echo "<br><br>";
		
		$totalpoints = ($totalcontacts * ($totalparks+1)) + $bonuspoints;
		echo "<b>Total Points:</b> " . $totalpoints . "<br>";
		
		echo "<br>";

		$sql = "select count(contactid) as contactcnt, sysbands.band from ospotalog ol join sysbands on ol.bandid=sysbands.sysbandsid group by ol.bandid";
		$result = $conn->query($sql);

		echo "<b>Total Contacts by Band: </b><br>";
		echo "<center>";
		echo "<table border=1>";
		echo "<tr>";
		echo "<th>Band</th><th>Count</th>";
		echo "</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["band"] . "</td>";
			echo "<td>" . $row["contactcnt"] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</center>";
		echo "<br>";


		echo "</td></tr>";
	echo "</table>";

?>