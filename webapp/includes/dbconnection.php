<?php 

//Datenbankverbindung herstellen

$servername = "localhost";
$user = "admin";
$password = "evgym1!";
$dbname = "homecontrol";
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$user, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 ?>