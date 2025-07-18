<?php 
include 'includes/dbconnection.php';
	
//Lese Werte aus 'scanner' aus

$sql = "SELECT * FROM scanner WHERE id_scanner = '1'";
$data = $conn->query($sql)->fetchAll();

//Gebe Werte für Ajax-Success Funktion aus

foreach ($data as $row) {

	echo "Protokoll: ".$row['protocol_scanner']." | Pulslänge: ".$row['pulselength_scanner']." | Pulswert: ".$row['value_scanner'];

}
 ?>