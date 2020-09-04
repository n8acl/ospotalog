<?php session_start();

$contestdashboard = 0;
$gmtime = gmdate("H:i");
$localtime = gmdate("H:i",strtotime('-4 hour'));

include('header.php');

$sql = "select os.contestcallsign, os.licenseclassid, op.parkid as location, op.wwffid as wwff, op.potaid as pota, op.parkname ";
$sql = $sql . "from ospotasettings os ";
$sql = $sql . "join ospotaparks op on op.ospotaparkid = os.parkid ";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
	$contestcallsign = $row["contestcallsign"];
	$location = $row["location"];
	$licenseclassid = $row["licenseclassid"];
	$wwff = $row["wwff"];
	$potaid = $row["pota"];
	$parkname = $row["parkname"];
}

if (!isset($_SESSION["band"])){
	$_SESSION["band"] = "10 M";
}

if (!isset($_SESSION["dupecheck"])){
	$_SESSION["dupecheck"] = 2;
}

if (!isset($_SESSION["callsign"])){
	$_SESSION["callsign"] = '';
}

if (!isset($_SESSION["parkid"])){
	$_SESSION["parkid"] = '';
}

if (!isset($_SESSION["stdx"])){
	$_SESSION["stdx"] = '';
}

echo "<hr>";
echo $parkname . ", " . $location . " | WWFF ID: " . $wwff . " | POTA ID: " . $potaid;
echo "<form method=post action=bmchange.php>";
echo "<h2>Exchange: " . $contestcallsign . ", " . $location ."</h2>";
echo '<b>Local Time:</b> <input type=text value = "' . $localtime . '" readonly style="width: 50px">&nbsp;&nbsp;';
echo '<b>UTC Time: <input type=text value = "' . $gmtime . '" readonly style="width: 50px">&nbsp;&nbsp;';
echo "<b>Band:</b> ";
$sql = "select distinct band, orderby from sysbands order by orderby";
$result = $conn->query($sql);

echo '<select name=band style="width: 60px">';
while($row = $result->fetch_assoc()) {
	echo '<option value="'. $row["band"] . '"';
	if ($row["band"] == $_SESSION["band"]) {
		echo ' selected>';
	} else {
		echo '>';
	}
echo $row["band"] . "</option>";
}
echo "</select>&nbsp;&nbsp;";

echo '<input type="submit" name="function" value="Set">&nbsp;&nbsp;';
echo "<b>Freq. Privledges:</b> ";
$sql = "select priv from sysbands where band = '" . $_SESSION["band"] . "' and licenseclassid = " . $licenseclassid . " and mode = 1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	echo '<input type=text value="'. $row["priv"] . '" style="width: 225px" readonly>';
}
echo "</form> <br><br>";

echo "<form method=post action=log.php>";
echo "<b>Callsign Received:</b> ";
echo '<input type=text value="'. $_SESSION["callsign"] . '" name=callsign style="width: 75px" autofocus>&nbsp;&nbsp;';
echo "<b>Ohio State Park ID:</b> ";
echo '<input type=text value="'. $_SESSION["parkid"] . '" name=parkid style="width: 50px">&nbsp;&nbsp;';
echo "<b>State or DX:</b> ";
echo '<input type=text value="'. $_SESSION["stdx"] . '" name=stdx style="width: 50px"><br><br>';
echo '<input name="log" type="submit" value="Submit"><input name = "log" type="submit" value="Check Dupe"><input name="log" type="submit" value="Clear">';
echo "</form>";

switch ($_SESSION["dupecheck"]) {
    case 0:
        echo '<font color="RED"><b>Contact a Dupe!</b></font><br><br>';
        $_SESSION["dupecheck"] = 2;
        break;
    case 1:
        echo '<font color="Green"><b>Contact OK! Can be Logged!</b></font><br><br>';
        $_SESSION["dupecheck"] = 2;
        break;
    case 3:
        echo '<font color="Red"><b>Contact a Dupe! Not Logged!</b></font><br><br>';
        $_SESSION["dupecheck"] = 2;
        break;
}
echo "<b>* If a Park ID is entered, do not enter a State. It is not needed. Likewise if a State is entered, there should be no Park ID.</b>";
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