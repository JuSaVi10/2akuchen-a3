<?php session_start(); include_once "conexion.php";?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área privada</title>
</head>
<body>
    <h1>Área privada</h1>
    <form class="col s12" action="" method="post">
    <input type="email" placeholder="Email" name="email">
    <input type="password" placeholder="Contraseña" name="password">
    </form>
</body>
</html>
