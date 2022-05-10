<?php
include "conexion.php";
if(!empty($_POST))
{
    if(empty($_POST['nombre'])||empty($_POST['nombre_empresa'])||empty($_POST['cif'])||empty($_POST['direccion'])||empty($_POST['email'])||empty($_POST['password'])){
        echo "Todos los campos son obligatorios";
    }else{
        $id = $_POST['id'];
        $nombre =  $_POST['nombre'] ;
        $empresa =$_POST['nombre_empresa'];
        $cif = $_POST['cif'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $password =$_POST['password'];

        $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email' or cif = '$cif' ");
        $result = mysqli_fetch_array($query);

        
            $query_update = mysqli_query($con, "UPDATE tabla_usuarios set nombre = '$nombre',nombre_empresa = '$empresa',cif = '$cif', direccion = '$direccion' ,email = '$email', password = '$password' WHERE id = $id");
            if($query_update){
                header("location: usuarios_confirmados.php");
            }else{
                echo "Actualización fallida";
            }
        
}
}
if(empty($_GET['id']))
{
    header("location: usuarios_confirmados.php");
}
$id = $_GET['id'];
$sql = mysqli_query($con,"SELECT tabla_usuarios.id,tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email,tabla_usuarios.password FROM tabla_usuarios WHERE id = $id");

$results = mysqli_num_rows($sql);
if($results >0){
    while ($data = mysqli_fetch_array($sql)){
        $id = $data['id'];
        $nombre = $data['nombre'];
        $empresa = $data['nombre_empresa']; 
        $cif = $data['cif']; 
        $direccion = $data['direccion']; 
        $email = $data['email'];
        $password = $data['password'];

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
    <link rel="stylesheet" type ="text/css" href="css/css_registro.css" screen = "all" />

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Editar</title>
</head>
<body>
    <div class="class_h2">
        <h2 style="font-weight:normal;">Editar</h2>
        <div class="uvc-heading-spacer line_only" >
            <span class="uvc-headings-line" ></span>
        </div>
    </div>

<div class = "container">
   
        <form id="registro" class="col s12" action="" method="post">
        <input type="hidden" name="id" value = "<?php echo $id ?>">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input placeholder="Nombre" name="nombre" class="nombre" type="text" value="<?php echo $nombre?>">
                <label for="nombre">Nombre</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="Nombre de la empresa" name="nombre_empresa" type="text" value="<?php echo $empresa?>">
            <label for="nombre_empresa">Nombre de la empresa</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="CIF" name="cif" type="text" value="<?php echo $cif?>">
            <label for="cif">CIF</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="Dirección" name="direccion" type="text" value="<?php echo $direccion?>">
            <label for="direccion">Dirección</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="Email" name="email" type="text" value="<?php echo $email?>">
            <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="Contraseña" name="password" type="text" value="<?php echo $password?>">
            <label for="password">Contraseña</label>
            </div>
        </div>
        <input type="submit" value="Actualizar" name="bbtn_enviar">
       
        
    </form>
</div>
    
</body>
</html>