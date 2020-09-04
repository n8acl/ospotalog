<?php session_start();

echo "<html>";
echo "<body>";
echo "<h1>phpContestLogger - Ohio State Parks on the Air " . date("Y") . "</h1>";
echo "<h3>Database Setup Script</h3>";
echo "<hr>";

echo "This script will create the new OSPOTA logging database for you. But I need your help to do that.<br><br>";
echo '<form method=post action="create1.php">';
echo "First I need a username/password that has the ability to create databases on your server, preferably the root user that was setup during the MySQL install.<br>";
echo "<b>MySQL Username:</b> " . '<input type=text value="" name=rootuser><br>';
echo "<b>MySQL Password:</b> " . '<input type=text value="" name=rootpwd><br><br>';
echo "Next I need a user name and password that will be created for the logging program to use. This will be created only for the logging database.<br>";
echo "<b>Logging Username:</b> " . '<input type=text value="" name=logginguser><br>';
echo "<b>Logging Password:</b> " . '<input type=text value="" name=loggingpwd><br><br>';
echo '<input type="submit" value="Submit">';
echo "</form>";

echo "<br>Once you click submit and the database has been created, you will be redirected to the main logging page. Please do not close or reload this window till then.";

echo "</body></html>";

?>