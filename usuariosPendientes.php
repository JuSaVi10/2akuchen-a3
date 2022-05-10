<?php
include "conexion.php";
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios sin Confirmar</title>
</head>
<body>
    
<?php
    include("header.html");
?>

    <h1>Lista de Usarios sin Confirmar</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th>Cif</th>
            <th>Dirección</th>
            <th>Email</th>
            <th>Password</th>
            <th>Acciones</th>
        </tr>
    
        <tr>
            <td>1</td>
            <td>Juan</td>
            <td>Betis</td>
            <td>123456789</td>
            <td>C/Fekir</td>
            <td>Manuelpellegrini@gmail.es</td>
            <td>VivaelBetisManquePierda</td>
            <td>
            <a href="">Aceptar</a>
            <a href="">Rechazar</a>
            </td>
            
        </tr>

    </table>
</body>
</html>