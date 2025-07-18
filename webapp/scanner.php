<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['value']) && isset($_GET['protocol']) && isset($_GET['pulselength'])) {
	$protocol = $_GET['protocol'];
	$value = $_GET['value'];
	$pulselength = $_GET['pulselength'];

} else {echo "no parameters"; die;}

include 'includes/dbconnection.php';

//Werte in 'scanner' mit Übergabewerte ersetzen

$sql_update = "UPDATE scanner SET value_scanner ='".$value."', protocol_scanner='".$protocol."', pulselength_scanner = '".$pulselength."' WHERE id_scanner = '1'";
$data_update = $conn->query($sql_update);


 ?>
