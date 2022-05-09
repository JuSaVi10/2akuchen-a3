<?php 
// datos para la coneccion a mysql define('DB_SERVER','localhost'); 
 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'usuarios';

$con = mysqli_connect($host,$user,$pass,$db);

if(!$con){
    echo "Error en la conexión";
};
 
?>