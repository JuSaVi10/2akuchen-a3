<?php session_start(); include_once "conexion.php";

$email ='';
$password ='';

if(!empty($_POST))
{
$alert = '';
if(empty($_POST['email'])||empty($_POST['password']))
{
    $alert = '<div class="bar error"> <p class = "msg_error">Todos los campos son obligatorios</p> </div>';
    $email = $_POST['email'];
    $password =$_POST['password'];
    

}else{
    include_once "conexion.php";
    $email = $_POST['email'];
    $password =$_POST['password'];
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
                $alert = '<div class="bar error"> <p class = "msg_error">Este usuario está pendiente de confirmación</p> </div>';

            }else{
                $email = $_POST['email'];
                $password = '';
                $alert = '<div class="bar error"> <p class = "msg_error">Contraseña incorrecta</p> </div>';
            }

        }else{
            $alert = '<div class="bar error"> <p class = "msg_error">El usuario no existe</p> </div>';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Área privada</title>
</head>
<body>
    <div class="class_h3">
        <h3>ÁREA PRIVADA</h3>
        <div class="uvc-heading-spacer line_only" >
            <span class="uvc-headings-line" ></span>
        </div>
    </div>

<div class = "container">
    <form class="col s12" action="" method="post">

        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input placeholder="Email" name="email" class="email" type="email" value="<?php echo $email?>">
                <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="Contraseña" name="password" type="password" value="<?php echo $password?>">
            <label for="password">Contraseña</label>
            </div>
        </div>

        <input type="submit" value="Acceder" name="bbtn_enviar">

        <div class="row">
            <div class="col s12 m6 l4">
            <?php echo isset($alert) ? $alert : '' ?>
            </div>
        </div>
        
    </form>
</div>

</body>
</html>