<?php

include 'conexion.php';
$email = $_POST['email'];
if(!empty($_POST)){

    if(!empty($_POST['email'])){


        $query_comprobar = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email'");
        $result = mysqli_fetch_array($query_comprobar);
        if($result > 0){
            $pass_reset = substr(md5(microtime()),8,16);
            $pass_encrypt = hash('sha512',$pass_reset);
            $email = $_POST['email'];
            $query_update = mysqli_query($con, "UPDATE tabla_usuarios set password = '$pass_encrypt' WHERE email = '$email'");
            if($query_update){
                echo "Contraseña Cambiada Correctamente <br>Compruebe correctamente";
            }else{
                echo "Actualización fallida";
            }
        }else{
            echo "Este usuario no existe";
        }


        $para = $_POST['email'];
        $asunto = 'Recordar contraseña';
        $cuerpo = "Su nueva contraseña es $pass_reset";

        mail($para,$asunto,$cuerpo);
        echo"Correo enviado con exito";

        


    }else{
        $alert ='<div class="bar error"> <p class = "msg_error">Introduzca un correo electronico para continuar.</p> </div>';
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
    <link rel="stylesheet" type ="text/css" href="css/style-default.css" screen = "all" />

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- Import Google Icon Font -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">

    <title>Registro</title>
</head>
<body>
    <div class="class_h2">
        <h2>REGISTRO</h2>
        <div class="uvc-heading-spacer line_only" >
            <span class="uvc-headings-line" ></span>
        </div>
    </div>

<div class = "container">
   
        <form id="registro" class="col s12" action="" method="post">
        
        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Email" name="email" type="text" value="">
            <label for="email">Email</label>
            </div>
        </div>

        <button name="bttn_remember" class="btn waves-effect waves-light btn modal-trigger green" type="submit">Recordar Contraseña<i class="material-icons right">how_to_reg</i></button>
        <a href="index.php" class="waves-effect waves-light btn"><i class="material-icons right">keyboard_return</i>Volver</a>
        

        <div class="row">
            <div class="col s12">
            <?php echo isset($alert) ? $alert : '' ?>
            </div>
        </div>
        
        </form>
    </div>
</body>
</html>

