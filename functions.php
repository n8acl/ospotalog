<?php 

switch ($_POST["function"]) {
	case "Home":
		header("location: index.php");
		break;
	case "Settings":
		header("location: settings.php");
		break;
	case "Dashboard":
		header("location: dashboard.php");
		break;
	case "Help":
		header("location: ./docs/help.html");
		break;
	case "Database Cabrillo Export":
		header("location: export.php");
		break;
	case "Delete Database":
		header("location: deletedatabase.php");
		break;
	default:
		header("location: index.php");
		break;
}


?>