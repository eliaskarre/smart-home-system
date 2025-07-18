<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['groupname'])) {
	$groupname = $_GET['groupname'];


} else {echo "Eingabe unvollständig."; die;}

include 'includes/dbconnection.php';


//Gruppe aus 'groups' löschen

$sql_delete = "DELETE FROM groups WHERE name_groups='".$groupname."'";
$data_delete = $conn->query($sql_delete);


//Überprüfe ob Löschung erfolgreich

$count = $data_delete->rowCount();

if ($count > 0) {
	echo $groupname." wurde aus dem System entfernt.";
} else {

	echo "Angegebene Gruppe nicht gefunden.";

}

 ?>
