<?php session_start();

if ($contestdashboard == 0) {
	echo "<b>Last 10 contacts this band (" . $_SESSION["band"] . ")</b><br>";
	echo "<table border = 1>"; // Contacts This band
		echo "<tr>";
		echo "<th>Contact ID</th><th>Callsign</th><th>Park</th><th>State</th><th>Band</th><th>Mode</th>";
		echo "</tr>";

		$sql = "select ol.contactid, ol.contactcallsign, sb.band, ifnull(op.parkid,0) as parkid, ifnull(ss.stateabrv,0) as stateabrv from ospotalog ol ";
		$sql = $sql . "join sysbands sb on sb.sysbandsid = ol.bandid ";
		$sql = $sql . "left join ospotaparks op on ol.parkid = op.ospotaparkid ";
		$sql = $sql . "left join sysstates ss on ss.sysstatesid = ol.stateid ";
		$sql = $sql . "where sb.band = '" . $_SESSION["band"] . "' order by contactid desc limit 10";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["contactid"] . "</td>";
			echo "<td>" . $row["contactcallsign"] . "</td>";
			echo "<td>";
			if ($row["parkid"] == "0") {
				echo "";
			} else {
				echo $row["parkid"];
			}
			echo "</td>";
			echo "<td>";
			if ($row["stateabrv"] == "0") {
				echo "";
			} else {
				echo $row["stateabrv"];
			}
			echo "</td>";
			echo "<td>" . $row["band"] . "</td>";
			echo "<td>PH</td>";
			echo "</tr>";
		}
	echo "</table>";//Contacts this band
	echo "<br><br><br>";
}
	if ($contestdashboard == 1) {
		echo "<b>Last 20 contacts Overall</b><br>";
	} else {
		echo "<b>Last 10 contacts Overall</b><br>";
	}
	echo "<table border = 1>"; // Contacts All bands
		echo "<tr>";
		echo "<th>Contact ID</th><th>Callsign</th><th>Park</th><th>State</th><th>Band</th><th>Mode</th>";
		echo "</tr>";

		$sql = "select ol.contactid, ol.contactcallsign, sb.band, ifnull(op.parkid,0) as parkid, ifnull(ss.stateabrv,0) as stateabrv from ospotalog ol ";
		$sql = $sql . "join sysbands sb on sb.sysbandsid = ol.bandid ";
		$sql = $sql . "left join ospotaparks op on ol.parkid = op.ospotaparkid ";
		$sql = $sql . "left join sysstates ss on ss.sysstatesid = ol.stateid ";
		if ($contestdashboard == 1) {
			$sql = $sql . "order by contactid desc limit 20";
		} else {
			$sql = $sql . "order by contactid desc limit 10";
		}
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["contactid"] . "</td>";
			echo "<td>" . $row["contactcallsign"] . "</td>";
			echo "<td>";
			if ($row["parkid"] == "0") {
				echo "";
			} else {
				echo $row["parkid"];
			}
			echo "</td>";
			echo "<td>";
			if ($row["stateabrv"] == "0") {
				echo "";
			} else {
				echo $row["stateabrv"];
			}
			echo "</td>";
			echo "<td>" . $row["band"] . "</td>";
			echo "<td>PH</td>";
			echo "</tr>";
		}
	echo "</table>";//Contacts all band

?>