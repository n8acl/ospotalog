<?php session_start();

$db_config = array(
    'server' => 'localhost',
    'username' => $_POST["rootuser"],
    'password' => $_POST["rootpwd"]
);

$conn = new mysqli($db_config['server'], $db_config['username'], $db_config['password']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlScript = file('ospota.sql');
foreach ($sqlScript as $line)	{
    
    $startWith = substr(trim($line), 0 ,2);
    $endWith = substr(trim($line), -1 ,1);
    
    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
    }
        
    $query = $query . $line;
    if ($endWith == ';') {
        mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
        $query= '';		
    }
}

$query = "DROP USER IF EXISTS '" . $_POST["logginguser"] ."'@'%';";
mysqli_query($conn,$query);

$query = "CREATE USER '" . $_POST["logginguser"] . "'@'%' IDENTIFIED BY '" . $_POST["loggingpwd"] . "';";
mysqli_query($conn,$query);

$query = "GRANT ALL PRIVILEGES ON ospotalog.* TO '" . $_POST["logginguser"] ."'@'%';";
mysqli_query($conn,$query);

$query = "FLUSH PRIVILEGES;";
mysqli_query($conn,$query);

//print "Database created";

$linefeed = "\n";

$text = "<?php session_start();" . $linefeed;
$text .= $linefeed;
$text .= '$db_config = array(' . $linefeed;
$text .= "	'server' => 'localhost'," . $linefeed;
$text .= "	'username' => '" . $_POST["logginguser"] . "'," . $linefeed;
$text .= "	'password' => '" . $_POST["loggingpwd"] . "'," . $linefeed;
$text .= "	'dbname' => 'ospotalog'" . $linefeed;
$text .= ");" . $linefeed;
$text .= $linefeed;
$text .= '$conn' . " = new mysqli(" . '$db_config' . "['server'], " . '$db_config' . "['username'], " . '$db_config' . "['password'], " . '$db_config' . "['dbname']);" . $linefeed;
$text .= $linefeed;
$text .= "if (" . '$conn' . "->connect_error) {" . $linefeed;
$text .= '    die("Connection failed: " . $conn->connect_error);' . $linefeed;
$text .= "}" . $linefeed;
$text .= $linefeed;
$text .= "?>" . $linefeed;

$dir = getcwd() . "/";
$filename = "db_config.php";

$myfile = fopen($dir . $filename, "w") or die("Unable to open file!");
fwrite($myfile, $text);
fclose($myfile);

header("location: index.php");
?>