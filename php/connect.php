<?php
$host='localhost';
$user='root';
$pw= '';
$db='mh_bd1';

$conn = mysqli_connect($host,$user,$pw,$db) or die ("no conecta al servidor local");

mysqli_select_db($conn,$db) or die ("no conecta a la base de datos");

?>