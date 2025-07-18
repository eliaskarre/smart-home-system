<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['groupname'])) {
	$groupname = $_GET['groupname'];


} else {echo "Eingabe unvollständig."; die;}

include 'includes/dbconnection.php';


//Gruppen-ID anhand des Gruppennamen bestimmen 

$sql = "SELECT id_groups FROM groups WHERE name_groups = '".$groupname."'";
$groupid = $conn->query($sql)->fetch();


//Lade Funkgeräte welche diesselbe Gruppen-ID haben

$sql = "SELECT * FROM codes WHERE id_groups='".$groupid["id_groups"]."' AND action='1'";
$data = $conn->query($sql)->fetchAll();

$counter = 1; 
$total = count($conn->query($sql)->fetchAll());


//Funkgeräte der Gruppe ausgeben und Beistriche setzen

foreach ($data as $row) {	
	echo $row['name_codes'];
	if ($counter < $total) {	
		echo ", ";
	}
	$counter++;
}



 ?>