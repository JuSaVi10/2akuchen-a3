<?php
$nombre ='';
$empresa ='';
$direccion = '';
$email ='';
$password ='';
$cif = '';
$password2 = '';
if(!empty($_POST))
{
    $alert = '';
    if(empty($_POST['nombre'])||empty($_POST['nombre_empresa'])||empty($_POST['cif'])||empty($_POST['direccion'])||empty($_POST['email'])||empty($_POST['password']||empty($_POST['password2'])))
    {
        $alert ='<p class = "msg_error">Todos los campos son obligatorios.</p>';
        $nombre =  $_POST['nombre'] ;
        $empresa =$_POST['nombre_empresa'];
        $cif = $_POST['cif'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $password =$_POST['password'];
        $password2 = $_POST['password2'];
    }else{
        include_once "conexion.php";
        $nombre =  $_POST['nombre'] ;
        $empresa =$_POST['nombre_empresa'];
        $cif = $_POST['cif'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $password =$_POST['password'];
        $password2 =$_POST['password2'];
        $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email' or cif = '$cif' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert = '<p class = "msg_error">El correo o el cif ya está registrado.</p>';
        }else{
            if($password == $password2){
            $query_insert = mysqli_query($con, "INSERT INTO tabla_usuarios(nombre,nombre_empresa,cif,direccion,email,password)VALUES('$nombre','$empresa','$cif','$direccion','$email','$password')");
            }else{
                $alert = '<p class = "msg_error">Las contraseñas no coinciden</p>';
            }
            if($query_insert){
                $alert = '<p class = "msg_error">Usuario registrado correctamente espere su confirmación.</p>';
                $nombre ='';
                $empresa ='';
                $cif = '';
                $direccion = '';
                $email ='';
                $password ='';
                $password2 ='';
            }else{
                $alert = '<p class = "msg_error">Error al crear al usuario, compruebe los campos</p>';
            }
        }
    }
    if(isset($_POST['bbtn_enviar'])){
        $patronCIP= "/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/";
    if(!preg_match($patronCIP,$_POST['cif'])){
        $nombre =  $_POST['nombre'] ;
        $empresa =$_POST['nombre_empresa'];
        $cif = $_POST['cif'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $password =$_POST['password'];
        $password2 =$_POST['password2'];
        $alert = '<p class = "msg_error">Contenido del cif no es válido</p><br>';
    }
}
    
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>

    <div class="row">
   
    <form class="registro" action="" method="post">
    <input type="text" placeholder="Nombre" name="nombre" value="<?php echo $nombre?>"> 
    <input type="text" placeholder="Nombre de Empresa" name="nombre_empresa" value="<?php echo $empresa?>">
    <input type="text" placeholder="CIF" name="cif" value="<?php echo $cif?>">
    <input type="text" placeholder="Dirección" name="direccion" value="<?php echo $direccion?>">
    <input type="email" placeholder="Email" name="email" value="<?php echo $email?>">
    <input type="password" placeholder="Contraseña" name="password" value="<?php echo $password?>">
    <input type="password" placeholder="Repetir contraseña" name="password2" value="<?php echo $password2?>">
    <input type="submit" value="Acceder" name="bbtn_enviar">
    </form>

    <div class="alert"> <?php echo isset($alert) ? $alert : '' ?></div>

</body>
</html>


