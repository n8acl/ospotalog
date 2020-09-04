<?php session_start();

//include('/var/www/html/db_config.php');
include('db_config.php');

echo "<html>";
if ($contestdashboard==1) {
	echo '<head><title>phpContestLogger</title><meta http-equiv="refresh" content="120"></head>';
} else {
	echo '<head><title>phpContestLogger</title></head>';
}
echo "<body>";
echo "<h1>phpContestLogger - Ohio State Parks on the Air " . date("Y") . "</h1>";
if ($contestdashboard==0) {
	echo "<hr>";
	echo "<form method=post action=functions.php>";
	echo '<input type="submit" name="function" value="Home">';
	echo '<input type="submit" name="function" value="Settings">';
	echo '<input type="submit" name="function" value="Dashboard">';
	echo '<input type="submit" name="function" value="Help">';
	echo "</form>";
}

?>
