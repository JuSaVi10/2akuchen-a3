<?php session_start(); include_once "conexion.php";

$email ='';
$password ='';

if(!empty($_POST))
{
$alert = '';
if(empty($_POST['email'])||empty($_POST['password']))
{
   echo'<p class = "msg_error">Todos los campos son obligatorios.</p>';
    $email = $_POST['email'];
    $password =$_POST['password'];
    

}else{
    include_once "conexion.php";
    $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email' and password = '$password' and estado = 'Confirmado' ");
    $result = mysqli_fetch_array($query);

    if($result>0){
        header("Location: hola.html");
    }else{
        $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email'");
        $result = mysqli_fetch_array($query);
        if($result>0){
            $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email' and password = '$password'");
            $result = mysqli_fetch_array($query);
            if($result>0){
                echo 'Este usuario está pendiente de confirmación';

            }else{
                $email = $_POST['email'];
                $password = '';
                echo 'contraseña incorrecta';
            }

        }else{
            echo 'el usuario no existe';
        }
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
    <title>Área privada</title>
</head>
<body>
    <h1>Área privada</h1>
    <form class="col s12" action="" method="post">
    <input type="email" placeholder="Email" name="email" value="<?php echo $email?>">
    <input type="password" placeholder="Contraseña" name="password" <?php echo $password?>" >
    <input type="submit" value="Acceder" name="bbtn_enviar">
    </form>

</body>
</html>