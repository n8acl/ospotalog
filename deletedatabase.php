<?php session_start();

include('header.php');

echo "<hr>";
echo "<h2>Delete Database</h2>";
echo "<form method=post action=deletedatabase1.php>";
echo "This will clear all data in the log and reset the database for a new contest.<br><br>";
echo "<b>ARE YOU SURE?</b><br>";
echo '<input type=submit name="deletedata" value="YES"><input type=submit name="deletedata" value="NO">';
echo "</form>";

?>