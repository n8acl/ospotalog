<?php session_start();

$sql = "select count(distinct parkid) as parkcnt from ospotalog where parkid <> 0";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$workedparkcnt = $row["parkcnt"];
}

$sql = "select count(ospotaparkid) as parkcnt from ospotaparks where ospotaparkid not in (select distinct parkid from ospotalog)";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$parkcnt = $row["parkcnt"];
}
echo "<table border=0>";
echo "<tr><td valign = top>";
	echo "<b>Parks Worked (" . $workedparkcnt . ")</b><br>";
	echo "<table border = 1>";
	echo "<tr>";
	echo "<th>Park ID</th><th>Park Name</th>";
	echo "</tr>";
	$sql = "select * from ospotaparks where ospotaparkid in (select distinct parkid from ospotalog) order by parkname";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row["parkid"] . "</td>";
		echo "<td>" . $row["parkname"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
echo "</td>";

echo "<td valign = top>";
	echo "<b>Parks to be Worked (" . $parkcnt . ")</b><br>";
	echo "<table border = 1>";
	echo "<tr>";
	echo "<th>ParkID</th><th>Park Name</th>";
	echo "</tr>";
	$sql = "select * from ospotaparks where ospotaparkid not in (select distinct parkid from ospotalog) order by parkname";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row["parkid"] . "</td>";
		echo "<td>" . $row["parkname"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";	
?>