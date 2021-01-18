<?php
require "connect.php";

$estado = $_POST['estado'];
$ubicacion = $_POST['ubicacion'];
$descripcion = $_POST['descripcion'];
$banos = $_POST['banos'];
$cuartos = $_POST['cuartos'];
$cocheras = $_POST['cocheras']; 
$usuario = "Jose";

$sql = "DELETE FROM img_nombre WHERE id = 1";
mysqli_query($conn,$sql);

$sql1 = "INSERT INTO casa(descripcion,recamaras,banos,cocheras,estado) VALUES('$descripcion',$cuartos,$banos,$cocheras,'$estado')";
if(!mysqli_query($conn,$sql1)){
	echo "Error consulta 1";
}


	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; 
			$source = $_FILES["archivo"]["tmp_name"][$key];
			
			$directorio = '../img/img_casas/'.$usuario.''; 
			
			$sql2 = "INSERT INTO img_nombre(id,nombre)VALUES(1,'$filename');";
			
			if(!mysqli_query($conn,$sql2)){
				die("Error en la consulta 2");
			}
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); 
			$target_path = $directorio.'/'.$filename;
			
			if(move_uploaded_file($source, $target_path)) {	
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {	
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir);
		}
	}
	

?>