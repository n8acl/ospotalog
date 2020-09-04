<?php session_start();

include('header.php');

$sql = "select * from ospotasettings";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$contestcallsign = $row["contestcallsign"];
	$clubname = $row["clubname"];
	$entrycat = $row["classid"];
	$location = $row["parkid"];
	$licenseclassid = $row["licenseclassid"];
	$contactname = $row["contactname"];
	$contactaddress = $row["contactaddress"];
	$contactcity = $row["contactcity"];
	$contactstate = $row["contactstate"];
	$contactzip = $row["contactzip"];
	$contactcountry = $row["contactcountry"];
	$contactemail = $row["contactemail"];
	$operators = $row["operators"];	
	$cabrillo = $row["cabrillo"];
}


//$sql = "select count(contactid) as contactcount from fdlog";
//$result = $conn->query($sql);

//while($row = $result->fetch_assoc()) {
//	$contactcount = $row["contactcount"];
//}

$contactcount = 0;

echo "<hr>";
echo "<h2>Settings</h2>";
if ($_SESSION["settingsupdated"] == 1) {
	echo "<font color = red>Settings Updated</font><br><br>";
	$_SESSION["settingsupdated"] = 0;
}

echo "<form method=post action=settings1.php>";
echo "<table border = 0>";
echo "<tr>";
echo "<td>";
echo "Contest Callsign: <input type=text name=contestcallsign value=". $contestcallsign . "><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Club Name: <input type=text name=clubname value="'. $clubname .'"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<tr>";
echo "<td>";
echo "Location: ";

$sql = "select * from ospotaparks order by parkname";
$result = $conn->query($sql);

echo "<select name=location>";
while($row = $result->fetch_assoc()) {
	echo "<option value=". $row["ospotaparkid"];
	if ($row["ospotaparkid"] == $location) {
		if ($contactcount >=1) {
			echo " selected disabled=disabled>";
		} else {
			echo " selected>";
		}
	} else {
		if ($contactcount >=1) {
			echo " disabled=disabled>";
		} else {
			echo ">";
		}
	}
echo $row["parkid"] . " - ". $row["parkname"] . "</option>";
}
echo "</select><br>";
echo "</td>";
echo "</tr>";
echo "<td>";
echo "License Class: ";

$sql = "select * from syslicenseclass";
$result = $conn->query($sql);

echo "<select name=licenseclass>";
while($row = $result->fetch_assoc()) {
	echo "<option value=". $row["syslicenseclassid"];
	if ($row["syslicenseclassid"] == $licenseclassid) {
		if ($contactcount >=1) {
			echo " selected disabled=disabled>";
		} else {
			echo " selected>";
		}
	} else {
		if ($contactcount >=1) {
			echo " disabled=disabled>";
		} else {
			echo ">";
		}
	}
echo $row["licenseclass"] . "</option>";
}
echo "</select><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Operators: <input type=text name=operators value="'. $operators . '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Will Submit Via Cabrillo Format? ';
echo '<input type="radio" name=cabrillo value="1"';
	if ($cabrillo == 1) {
		echo ' checked';
	}
	
	echo '> Yes <input type="radio" name=cabrillo value="0"';
	
	if ($cabrillo == 0) {
		echo ' checked';
	}	
	
	echo '> No';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo '<input type="submit" name="function" value="Update"><input type="submit" name="function" value="Clear">';
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<h2>Contact Information:</h2>";
echo "<table border = 0>";
echo "<tr>";
echo "<td>";
echo 'Name: <input type=text name=contactname value="'. $contactname . '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Address: <input type=text name=contactaddress value="'. $contactaddress . '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'City: <input type=text name=contactcity value="'. $contactcity . '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'State: <input type=text name=contactstate value="'. $contactstate . '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Zip Code: <input type=text name=contactzip value="'. $contactzip . '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Country: <input type=text name=contactcountry value="'. $contactcountry. '"><br>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo 'Email Address: <input type=text name=contactemail value="'. $contactemail . '"><br>';
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo '<input type="submit" name="function" value="Update"><input type="submit" name="function" value="Clear">';
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "<hr>";
echo "<form method=post action=functions.php>";
echo '<input type="submit" name=function value="Delete Database">';
echo '<input type="submit" name=function value="Database Cabrillo Export">';
echo "</form>";

echo "</body></html>";
?>