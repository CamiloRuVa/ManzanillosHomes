<?php
require 'connect.php';
//primero tengo que ver si el usuario está memorizado en una cookie
if (isset($_COOKIE["id_usuario"]) && isset($_COOKIE["num_acc"])){
    //Tengo cookies memorizadas
    //además voy a comprobar que esas variables no estén vacías
    if ($_COOKIE["id_usuario"]!="" || $_COOKIE["num_acc"]!=""){
       //Voy a ver si corresponden con algún usuario
       $ssql = "select * from usuarios where id=" . $_COOKIE["id_usuario"] . " and num_acc='" . $_COOKIE["num_acc"] . "' and num_acc<>''";
       $rs = mysqli_query($conn,$ssql);
       if (!empty($rs) AND mysqli_num_rows($rs)==1){
          echo "<b>Tengo un usuario correcto en una cookie</b>";
          $usuario_encontrado = mysqli_fetch_object($rs);
          echo "<br>Eres el usuario número " . $usuario_encontrado->id . ", de nombre " . $usuario_encontrado->nombre;
          //header ("Location: contenidos_protegidos_cookie.php");
       }
    }
 } 
?>