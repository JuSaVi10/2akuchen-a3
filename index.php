<?php session_start(); include_once "conexion.php";
?>
<form class="registro" action="" method="post">
<div><label>Usuario:</label> <input type="text" name="usuario"></div>
<div><label>Clave:</label> <input type="password" name="password"></div>
<div><label>Repetir Clave:</label> <input type="password" name="repassword"></div>
<div><input type="submit" name="enviar" value="Registrar"></div>
</form>



