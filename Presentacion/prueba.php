<?php
include '../Ldatos/datafactory.php';

$db=new DatabaseFactory();

$conexion=$db-> getDatabase();

if($conexion){
    echo 'conectado';
}


?>