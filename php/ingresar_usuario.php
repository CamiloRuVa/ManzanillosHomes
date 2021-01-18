<?php
include 'connect.php';

$correo = $_POST['correo'];
$contraseña = $_POST['con'];

$sql = "Select contra,id FROM usuarios WHERE correo='$correo'";

$consulta = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($consulta);
$comcon = $row[0];
$id = $row[1];

if(!$sql){
    die("Correo no Existe");
}
   
if(!password_verify($contraseña,$comcon)){
    die("Falló");
}

if($_POST['guardar_clave'] == "1"){
    $numero_al = mt_rand(100000000,999999999);
    $sql2 = "UPDATE usuarios set num_acc='$numero_al' where id = '$id'";
    mysqli_query($conn,$sql2);
    setcookie("id_usuario",$id);
    setcookie("num_acc",$numero_al);
}

header("Location:../index.html");

?>