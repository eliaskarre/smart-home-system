<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['codename'])) {
	$codename = $_GET['codename'];


} else {echo "Eingabe unvollständig."; die;}

include 'includes/dbconnection.php';

//Funkgerät aus 'codes' löschen

$sql_delete = "DELETE FROM codes WHERE name_codes='".$codename."'";
$data_delete = $conn->query($sql_delete);


//Funkgerät-Status aus 'states' löschen

$sql_delete = "DELETE FROM state WHERE name_codes='".$codename."'";
$data_delete = $conn->query($sql_delete);

//Überprüfe ob Löschen erfolgreich

$count = $data_delete->rowCount();

if ($count > 0) {
	echo $codename." wurde aus dem System entfernt.";
} else {

	echo "Angegebenes Gerät nicht gefunden.";

}


 ?>