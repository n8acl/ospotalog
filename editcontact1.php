<?php session_start();

include('db_config.php');

if ($_POST["editdata"] == "Update"){

    $sql = "select licenseclassid from ospotasettings";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
    $licenseclassid = $row["licenseclassid"];
    }

    $sql = "select sysbandsid from sysbands where band = '" . strtoupper($_POST['band']) . "' and licenseclassid = " . $licenseclassid . " and mode =1";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
    $sysbandsid = $row["sysbandsid"];
    }

    if (strtoupper($_POST["parkid"]) == ""){
        $ospotaparkid = 76;
    } else {

        $sql = "select ospotaparkid from ospotaparks where parkid = '" . strtoupper($_POST["parkid"]) . "'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
        $ospotaparkid = $row["ospotaparkid"];
        }
    }

    if (strtoupper($_POST["stateabrv"]) == ""){
        $sysstatesid = 52;

    } else {

        $sql = "select sysstatesid from sysstates where stateabrv = '" . strtoupper($_POST["stateabrv"]) . "'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
        $sysstatesid = $row["sysstatesid"];
        }
    }

    $sql = "update ospotalog ";
    $sql .= "set contactcallsign = '" . strtoupper($_POST['callsign']) . "', ";
    $sql .= "parkid = " . $ospotaparkid . ", ";
    $sql .= "bandid = " . $sysbandsid . ", ";
    $sql .= "stateid = " . $sysstatesid . " ";
    $sql .= "where contactid = " . $_SESSION["contactid"];
    $conn->query($sql);
    header("location: index.php");	
} else {
    $sql = "delete from ospotalog where contactid = " . $_SESSION["contactid"];
    $conn->query($sql);
    header("location: index.php");	
}

header("location: index.php");
?>