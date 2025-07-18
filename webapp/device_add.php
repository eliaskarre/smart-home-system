<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['codename']) && isset($_GET['protocol']) && isset($_GET['pulselength']) && isset($_GET['value']) && isset($_GET['action']) && isset($_GET['type'])) {
	$codename = $_GET['codename'];
	$protocol = $_GET['protocol'];
	$pulselength = $_GET['pulselength'];
	$value = $_GET['value'];
	$action = $_GET['action'];
	$type = $_GET['type'];

} else {echo "Eingabe unvollständig."; die;}

include 'includes/dbconnection.php';

//Neues Funkgerät-Signal anhand den Übergabewerten hinzufügen

$sql_insert = "INSERT INTO codes (name_codes, protocol, pulselength, value, action, type)
VALUES ('".$codename."',".$protocol.",".$pulselength.",".$value.",".$action.", '".$type."')";
$data_insert = $conn->query($sql_insert);


//Neuen Status für das Funkgerät anlegen

if ($action == "1") {
	
	$sql_insert = "INSERT INTO state (name_codes, state)
	VALUES ('".$codename."','0')";
	$data_insert = $conn->query($sql_insert);
}

//Prüfe ob Hinzufügen erfolgreich

$count = $data_insert->rowCount();

if ($count > 0) {
	echo "Signal für ".$codename." wurde dem System hinzugefügt.";
} else {

	echo "Signal konnte nicht hinzugefügt werden.";
}


?>