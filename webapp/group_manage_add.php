<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['codename']) && isset($_GET['groupname'])) {
	$codename = $_GET['codename'];
	$groupname = $_GET['groupname'];
} else {echo "Eingabe unvollständig."; die;}


include 'includes/dbconnection.php';

//Gruppen-ID anhand des Gruppennamen bestimmen 

$sql = "SELECT id_groups FROM groups WHERE name_groups = '".$groupname."'";
$groupid = $conn->query($sql)->fetch();


//Die Gruppe dem Funkgerät hinzufügen
	
$sql_update = "UPDATE codes SET id_groups ='".$groupid['id_groups']."' WHERE name_codes = '".$codename."'";
$data_update = $conn->query($sql_update);


 ?>