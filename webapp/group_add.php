<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['groupname'])) {
	$groupname = $_GET['groupname'];

} else {echo "Eingabe unvollständig."; die;}


include 'includes/dbconnection.php';


//Gruppe hinzufügen

$sql_insert = "INSERT INTO groups (name_groups)
VALUES ('".$groupname."')";
$data_insert = $conn->query($sql_insert);


//Prüfe ob Hinzufügen erfolgreich

$count = $data_insert->rowCount();

if ($count > 0) {
	echo $groupname." wurde als Gruppe hinzugefügt.";
} else {

	echo "Gruppe konnte nicht hinzugefügt werden.";

}



 ?>