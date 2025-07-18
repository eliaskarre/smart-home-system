<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['codename'])) {
	$codename = $_GET['codename'];
} else {echo "Eingabe unvollständig."; die;}


include 'includes/dbconnection.php';


//Gruppe für Funkgerät löschen

$sql_update = "UPDATE codes SET id_groups = NULL WHERE name_codes = '".$codename."'";
$data_update = $conn->query($sql_update);

echo $codename." wurde aus der Gruppe entfernt.";

 ?>