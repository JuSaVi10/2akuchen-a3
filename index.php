!<?php session_start(); include "conexion.php";
include 'SED.php';

$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($_POST))
{
if(isset($_POST['bbtn_registrar'])){
    header("Location: registro.php");
}
$alert = '';

    if(empty($_POST['email'])||empty($_POST['password']))
    {
        $alert = '<div class="bar error"> <p class = "msg_error">Todos los campos son obligatorios</p> </div>';
        $email = $_POST['email'];
        $password =$_POST['password'];
    }else{
            include_once "conexion.php";
            $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE email = '$email'");
            $nr = mysqli_num_rows($query);
            $result = mysqli_fetch_array($query);

            if($result > 0){
                $password_fuerte = secure::encrypt($password);
                if($result['password']== $password_fuerte){
                    if($result['estado'] == 'Confirmado'){
                        header("Location: hola.html"); 
                    }else{
                        $alert = '<div class="bar warning"> <p class = "msg_error">Este usuario está pendiente de confirmación</p> </div>';
                    }
                }else{
                    $alert = '<div class="bar error"> <p class = "msg_error">Contraseña incorrecta</p> </div>';
                    echo $password_fuerte;
                    $password = '';
                }
            }else{
                $alert = '<div class="bar error"> <p class = "msg_error">El usuario no existe</p> </div>';
                $password = '';
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

    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">

    <link rel="stylesheet" type ="text/css" href="css/style-default.css" screen = "all" />    
    <title>Área privada</title>

    
</head>
<body>
    <div class="class_h2">
        <h2>ÁREA PRIVADA</h2>
    </div>

<div class = "container" >
    <form class="col s12" action="" method="post">

        <div class="row">
            <div class="input-field col s12 ">
                <input placeholder="Email" name="email" class="email" type="email" value="<?php echo $email?>">
                <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 ">
            <input placeholder="Contraseña" name="password" type="password" value="<?php echo $password?>">
            <label for="password">Contraseña</label>
            </div>
        </div>
        <button name="bttn_enviar" class="btn waves-effect waves-light btn modal-trigger green" type="submit">Acceder<i class="material-icons right">login</i></button>
        <a href="registro.php" class="waves-effect waves-light btn"><i class="material-icons right">how_to_reg</i>Registrar</a>
        <div class="row">
            <div class="col s12 ">
            <?php echo isset($alert) ? $alert : '' ?>
            </div>
        </div>  
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

