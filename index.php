<?php session_start(); include "conexion.php";

$email = $_POST['email'];
$password =$_POST['password'];


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
    $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email'");
    $nr = mysqli_num_rows($query);
    $result = mysqli_fetch_array($query);
    
    
    if(($nr == 1)){
        $password_fuerte = hash('sha512',$password);
        if($result['password']== $password_fuerte){
            if($result['estado']== 'Confirmado'){
                header("Location: hola.html"); 
            }else{
                $alert = '<div class="bar error"> <p class = "msg_error">Este usuario está pendiente de confirmación</p> </div>';
                $password = '';
            }
        }else{
            $alert = '<div class="bar error"> <p class = "msg_error">Contraseña incorrecta</p> </div>';
            $password = '';
        }
    }else{
        $alert = '<div class="bar error"> <p class = "msg_error">El usuario no existe</p> </div>';
        $email = '';
        $password = '';
    }
      
    }
}

if(isset($_POST['bbtn_registrar'])){
    header("Location: registro.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type ="text/css" href="css/css.css" screen = "all" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <title>Área privada</title>
</head>
<body>
    <div class="class_h2">
        <h2>ÁREA PRIVADA</h2>
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
        <input type="submit" value="Registrar" name="bbtn_registrar">
        <div class="row">
            <div class="col s12 m6 l4">
            <?php echo isset($alert) ? $alert : '' ?>
            </div>
        </div>
        
    </form>
</div>

</body>
</html>