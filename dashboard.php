<?php session_start();

$contestdashboard = 1;

include('header.php');

$sql = "select os.contestcallsign, os.licenseclassid, op.parkid as location ";
$sql = $sql . "from ospotasettings os ";
$sql = $sql . "join ospotaparks op on op.ospotaparkid = os.parkid ";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$contestcallsign = $row["contestcallsign"];
	$location = $row["location"];
	$licenseclassid = $row["licenseclassid"];
}


echo "<hr>";
echo "<form method=post action=bmchange.php>";
echo "<h2>Exchange: " . $contestcallsign . ", " . $location ."</h2>";
echo '<b>Local Time:</b> <input type=text value = "' . date("H:i") . '" readonly style="width: 50px">&nbsp;&nbsp;';
echo '<b>UTC Time: <input type=text value = "' . gmdate("H:i") . '" readonly style="width: 50px">&nbsp;&nbsp;';
echo '<br><br>*Page Auto-refreshes every 2 minutes';

echo "<hr>";
echo "<table border = 0>"; //Overall table for each block. One Row
	echo "<tr>";
	echo "<td valign = top>"; // Realtime log list
		include('realtimelist.php');
	echo"</td>"; 
	
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>"; // Spacer

	echo "<td valign = top>"; //Realtime Score
		include('currentscores.php');
	echo "</td>"; 

	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>"; // Spacer
	
	echo "<td valign = top>"; // Sections worked/not worked
		include('currentparks.php');
	echo "</td>"; 


	echo "</tr>";
echo "</table>";
echo "</body></html>";
?>