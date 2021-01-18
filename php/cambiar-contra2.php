<?php
include 'connect.php';

$codigo = $_POST['codigo_con'];
$contra1 = $_POST['nueva_con'];
$contra2 = $_POST['nueva_con2'];

$sql = "Select id FROM usuarios WHERE cam_contr= $codigo";
$consulta = mysqli_query($conn, $sql);
if($consulta){
    $row = mysqli_fetch_row($consulta);
    $id = $row[0];
}
else{
    echo "Error 1";
}


if(!mysqli_query($conn, $sql)){
    die("Codigo no Existe");
}

if(!($contra1 == $contra2)){
    die("Contraseñas no Coinciden");
}

$contra_hash = password_hash($contra1, PASSWORD_DEFAULT);
#$sql2 ="INSERT INTO usuarios (contra) VALUES ('$contra_hash') WHERE id = '$id'";
$sql2 = "UPDATE usuarios SET contra = '$contra_hash' WHERE id = '$id'";
if(mysqli_query($conn, $sql2)){
    header("Location:../index.html");
}
else{
    echo "Error al cambiar contraseña";
}


?>