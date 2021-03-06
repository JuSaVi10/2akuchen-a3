<?php
include 'SED.php';
$nombre ='';
$empresa ='';
$direccion = '';
$email ='';
$password ='';
$cif = '';
$password2 = '';
$valid = false;
if(!empty($_POST))
{
    $alert = '';
    if(empty($_POST['nombre'])||empty($_POST['nombre_empresa'])||empty($_POST['cif'])||empty($_POST['direccion'])||empty($_POST['email'])||empty($_POST['password']||empty($_POST['password2'])))
    {
        $alert ='<div class="bar error"> <p class = "msg_error">Todos los campos son obligatorios.</p> </div>';
        $nombre =  $_POST['nombre'] ;
        $empresa =$_POST['nombre_empresa'];
        $cif = $_POST['cif'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $password =$_POST['password'];
        $password2 = $_POST['password2'];

    }else{
        include "conexion.php";
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
            $alert = '<div class="bar error"> <p class = "msg_error">El correo o el cif ya está registrado.</p>  </div>';
        }else{
            $patronCIF= "/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/";
            $patronPass = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/";
            if(!preg_match($patronCIF,$_POST['cif'])){
                $nombre =  $_POST['nombre'] ;
                $empresa =$_POST['nombre_empresa'];
                $cif = $_POST['cif'];
                $direccion = $_POST['direccion'];
                $email = $_POST['email'];
                $password =$_POST['password'];
                $password2 =$_POST['password2'];
                $alert = '<div class="bar error"> <p class = "msg_error">Contenido del cif no es válido</p> </div> <br>';
            }else{
                if(preg_match($patronPass,$_POST['password'])){
                    $valid = true;
                    if($password == $password2 && $valid == true){
                        $encrypt_password = secure::encrypt($password);
                        $query_insert = mysqli_query($con, "INSERT INTO tabla_usuarios(nombre,nombre_empresa,cif,direccion,email,password)VALUES('$nombre','$empresa','$cif','$direccion','$email','$encrypt_password')");
                        }else{
                            $alert = '<div class="bar error"> <p class = "msg_error">Las contraseñas no coinciden</p> </div>';
                        }
                        if($query_insert){
                            $alert = '<div class="bar success"> <p class = "msg_error">Usuario registrado correctamente espere su confirmación.</p> </div>';
                            $nombre ='';
                            $empresa ='';
                            $cif = '';
                            $direccion = '';
                            $email ='';
                            $password ='';
                            $password2 ='';
                        }else{
                            $alert = '<div class="bar error"> <p class = "msg_error">Error al crear al usuario, compruebe los campos</p> </div>';
                        }
                }else{
                    $alert = '<div class="bar error"> <p class = "msg_error">La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.</p> </div> <br>';
                }
                
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
                <input placeholder="Nombre" name="nombre" class="nombre" type="text" value="<?php echo $nombre?>">
                <label for="nombre">Nombre</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Nombre de la empresa" name="nombre_empresa" type="text" value="<?php echo $empresa?>">
            <label for="nombre_empresa">Nombre de la empresa</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="CIF" name="cif" type="text" value="<?php echo $cif?>">
            <label for="cif">CIF</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Dirección" name="direccion" type="text" value="<?php echo $direccion?>">
            <label for="direccion">Dirección</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Email" name="email" type="text" value="<?php echo $email?>">
            <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Contraseña" name="password" type="password" value="<?php echo $password?>">
            <label for="password">Contraseña</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Repetir contraseña" name="password2" type="password" value="<?php echo $password2?>">
            <label for="password2">Repetir contraseña</label>
            </div>
        </div>
        <button name="bttn_registrar" class="btn waves-effect waves-light btn modal-trigger green" type="submit">Registrar<i class="material-icons right">how_to_reg</i></button>
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

