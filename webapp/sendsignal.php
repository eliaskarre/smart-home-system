<?php 

//Übergabewerte überprüfen und speichern

if (isset($_GET['codename'])) {
	$codename = $_GET['codename'];
} else {echo "no codename"; die;}

include 'includes/dbconnection.php';


//Lade und speichere Status von Funkgerät

$sql = "SELECT * FROM state WHERE name_codes = '".$codename."'";
$data = $conn->query($sql)->fetchAll();

foreach ($data as $row) {

$state = $row['state'];

}

$sql = ""; //SQL Varible leeren


//Wenn Status Aus -> Lade Parameter für ein An-Signal und setze Status auf An

if ($state == 0) {
	$sql = "SELECT * FROM codes WHERE action = '1' AND name_codes = '".$codename."'";
	
	$sql_update = "UPDATE state SET state='1' WHERE name_codes = '".$codename."'";
	$data_update = $conn->query($sql_update);
	echo "1";
}


//Wenn Status An -> Lade Parameter für ein Aus-Signal und setze Status auf Aus

if ($state == 1) {
	$sql = "SELECT * FROM codes WHERE action = '0' AND name_codes = '".$codename."'";
	
	$sql_update = "UPDATE state SET state='0' WHERE name_codes = '".$codename."'";
	$data_update = $conn->query($sql_update);
	echo "0";
}

//Wenn Status ungültig -> Fehler ausgeben und Beenden

if ($state != 0 && $state != 1) {
	echo "no State";
	die;
}



$data = $conn->query($sql)->fetchAll(); //SQL Befehl ausführen

//Sendeparameter in Variblen zwischenspeichern

foreach ($data as $row) {

$value = $row['value'];
$pulselength = $row['pulselength'];
$protocol = $row['protocol'];

}


//Sende HTTP-Request mit Sendeparametern an den Sende-Microcontroller

$ch = curl_init("http://172.20.10.3/send?protocol=".$protocol."&pulselength=".$pulselength."&value=".$value);
curl_setopt($ch, CURLOPT_NOBODY, 1);
curl_exec($ch);
curl_close($ch);

 ?>