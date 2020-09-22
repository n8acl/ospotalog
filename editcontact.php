<?php session_start();

include('header.php');

$_SESSION["contactid"] = $_GET["id"];

$sql = "select contactcallsign, sb.band, op.parkid, s.stateabrv ";
$sql .= "from ospotalog ol ";
$sql .= "join sysbands sb on ol.bandid = sb.sysbandsid ";
$sql .= "join ospotaparks op on ol.parkid = op.ospotaparkid ";
$sql .= "join sysstates s on s.sysstatesid = ol.stateid ";
$sql .= "where ol.contactid = " . $_SESSION["contactid"];
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$callsign = $row["contactcallsign"];
	$band = $row["band"];
	$parkid = $row["parkid"];
	$stateabrv = $row["stateabrv"];
}

echo "<hr>";
echo "<h2>Edit Contact</h2>";
echo "<form method=post action=editcontact1.php>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Contact ID: " . $_SESSION["contactid"] . "</td>";
echo "</tr>";
echo "<tr>";
echo '<td>Callsign: <input type=text name=callsign value = "' . $callsign . '" style="width: 65px"></td>';
echo "</tr>";
echo "<tr>";
echo '<td>Park ID: <input type=text name=parkid value = "' . $parkid . '" style="width: 50px"></td>';
echo "</tr>";
echo "<tr>";
echo '<td>State: <input type=text name=stateabrv value = "' . $stateabrv . '" style="width: 50px"></td>';
echo "</tr>";
echo "<tr>";
echo '<td>Band: ';
$sql = "select distinct band, orderby from sysbands order by orderby";
$result = $conn->query($sql);

echo '<select name=band style="width: 105px">';
while($row = $result->fetch_assoc()) {
	echo '<option value="'. $row["band"] . '"';
	if ($row["band"] == $band) {
		echo ' selected>';
	} else {
		echo '>';
	}
echo $row["band"] . "</option>";
}
echo "</td>";
echo "</tr>";
echo "</table>";
echo '<input type=submit name="editdata" value="Update"><input type=submit name="editdata" value="Delete">';
echo "</form>";

?>