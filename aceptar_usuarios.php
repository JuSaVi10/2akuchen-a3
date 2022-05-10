<?php
include "conexion.php";
if(!empty($_POST))
{
$idusuario = $_POST['idusuario'];
$query_update = mysqli_query($con,"UPDATE tabla_usuarios SET estado = 'Confirmado' WHERE id =$idusuario");
if($query_update){
    header("location:usuarios_sin_confirmar.php");
}else{
    echo "Error al aceptar $idusuario";
}
}

if(empty($_REQUEST['id']))
{
header("location:usuarios_sin_confirmar.php");
}else{
    $idusuario = $_REQUEST['id'];
    $query = mysqli_query($con, "SELECT tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email FROM tabla_usuarios WHERE tabla_usuarios.id = $idusuario");
    //$query = mysqli_query($con, "UPDATE tabla_usuarios SET estado = 'Confirmado' WHERE id= $idusuario")

    $result = mysqli_num_rows($query);

    if($result>0){
        while( $data = mysqli_fetch_array($query)){
            $nombre = $data['nombre'];
            $nombre_empresa = $data['nombre_empresa'];
            $cif = $data['cif'];
            $direccion = $data['direccion'];
            $email = $data['email'];

        }
    }else{
        header("location: usuarios_sin_confirmar.php");
    }
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechazar</title>
</head>
<body>
    <h1>Rechazar Usuario</h1>
    <h2>¿Seguro que quieres aceptar el siguiente usuario?</h2>
    <p><strong>Nombre: </strong><span><?php echo $nombre ?></span></p>
    <p><strong>Nombre de Empresa:  </strong><span><?php echo $nombre_empresa ?></span></p>
    <p><strong>Cif: </strong><span><?php echo $cif ?></span></p>
    <p><strong>Dirección: </strong><span><?php echo $direccion ?></span></p>
    <p><strong>Email: </strong><span><?php echo $email ?></span></p>

    <form method="post" action="">
        <input type="hidden" name="idusuario" value=<?php echo $idusuario ?>>
        <a href="usuarios_sin_confirmar.php">Cancelar</a>
        <input type="submit" value="Aceptar">
    </form>
    
</body>
</html>