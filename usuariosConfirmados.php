<?php
include "conexion.php";
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type ="text/css" href="css/j.css" screen = "all" />
    <title>Usuarios confirmados</title>
    
</head>

<body>

<!-- Cabecera -->
<?php
    include("header.html");
?>

<h3 style="text-align:center;">LISTA DE USUARIOS CONFIRMADOS</h3>
<div class="container">
    <?php
        $query = mysqli_query($con, "SELECT tabla_usuarios.id,tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email,tabla_usuarios.password FROM tabla_usuarios WHERE tabla_usuarios.estado = 'Confirmado'");
        $result = mysqli_num_rows($query);
        $alert = '';
        if($result>0){
    ?>
    
    <table id="tablaConfirmados" class="striped centered responsive-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>Cif</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php
            while($data = mysqli_fetch_array($query)){
        ?>
        <tbody>
            <tr>
                <td><?php echo $data['id'] ?></td>
                <td><?php echo $data['nombre'] ?></td>
                <td><?php echo $data['nombre_empresa'] ?></td>
                <td><?php echo $data['cif'] ?></td>
                <td><?php echo $data['direccion'] ?></td>
                <td><?php echo $data['email'] ?></td>
                <td>
                    <button href = "usuariosConfirmados.php?idusuario=<?php echo $id = $data['id'];?>" data-target="idModalEdit" class="btn waves-effect waves-light btn modal-trigger teal" type="submit">Editar<i class="material-icons right">edit</i></button>
                    <button href = "usuariosConfirmados.php?idusuario=<?php echo $id = $data['id'];?>" data-target="idModal" class="btn waves-effect waves-light btn modal-trigger red" type="submit">Rechazar<i class="material-icons right">delete</i></button>
                </td>
            </tr>
        </tbody>
        <?php
                echo $alert;
                
            ?>
        <?php

            }
            }else{
                echo "No hay usuarios para confirmar";
            }
            if($result>0){
            $query = "SELECT tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email,tabla_usuarios.password,tabla_usuarios.estado FROM tabla_usuarios WHERE tabla_usuarios.id = $id";
            $resultado = mysqli_query($con, $query);
            $num_row = mysqli_num_rows($resultado);
                if($num_row>0){
                    while( $data = mysqli_fetch_array($resultado)){
                        $nombre = $data['nombre'];
                        $nombre_empresa = $data['nombre_empresa'];
                        $cif = $data['cif'];
                        $direccion = $data['direccion'];
                        $email = $data['email'];
                        $password = $data['password'];
                    }
                }else{
                    header("location: usuariosConfirmados.php");
                }
            }
            ?>
    </table>
</div>
    <!-- Vista del Modal de Editar Confirmados-->
    <div class="container section">
    <div id="idModalEdit" class="modal">
        
    <div class="class_h2">
        <h2 style="font-weight:normal;text-align:center;padding-top:20px;color:orange;">EDITAR</h2>
        <div class="uvc-heading-spacer line_only" >
            <span class="uvc-headings-line" ></span>
        </div>
    </div>

<div class = "container center">
   
    <form id="registro" class="col s12 " action="" method="post">
        <input type="hidden" name="id" value = "<?php echo $id ?>">
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <input placeholder="Nombre" name="nombre" class="nombre" type="text" value="<?php echo $nombre?>">
                <label for="nombre">Nombre</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
            <input placeholder="Nombre de la empresa" name="nombre_empresa" type="text" value="<?php echo $nombre_empresa?>">
            <label for="nombre_empresa">Nombre de la empresa</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
            <input placeholder="CIF" name="cif" type="text" value="<?php echo $cif?>">
            <label for="cif">CIF</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
            <input placeholder="Dirección" name="direccion" type="text" value="<?php echo $direccion?>">
            <label for="direccion">Dirección</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
            <input placeholder="Email" name="email" type="text" value="<?php echo $email?>">
            <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
            <input placeholder="Contraseña" name="password" type="text" value="<?php echo $password?>">
            <label for="password">Contraseña</label>
            </div>
        </div>

        <a class="btn modal-close red" href="usuariosConfirmados.php">Cancelar</a>
        <button class="btn waves-effect waves-light green" type="submit" name="btnUpdate">Actualizar</button>
        </div>
    </div>
</div>

<?php
 if(isset($_POST['btnUpdate']))
 {
        if(empty($_POST['nombre'])||empty($_POST['nombre_empresa'])||empty($_POST['cif'])||empty($_POST['direccion'])||empty($_POST['email'])||empty($_POST['password'])){
            echo "Todos los campos son obligatorios";
        }else{
            $id = $_POST['id'];
            $nombre =  $_POST['nombre'] ;
            $nombre_empresa = $_POST['nombre_empresa'];
            $cif = $_POST['cif'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $password =$_POST['password'];
    
            $query = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email' or cif = '$cif' ");
            $result = mysqli_fetch_array($query);
    
            $query_comprobar = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE  email = '$email' or cif = '$cif' and id is not '$id' ");
            $result2 = mysqli_fetch_array($query);

            $patronCIF= "/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/";
            $patronPass = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/";
            if(!preg_match($patronCIF,$_POST['cif'])){
                $alert = '<div class="bar error"> <p class = "msg_error">El formato CIF no es válido</p> </div> <br>';            
            }
            
            if(!preg_match($patronPass,$_POST['password'])){
                $alert = '<div class="bar error"> <p class = "msg_error">La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.</p> </div> <br>';            
            }
 
            if($result2 == 10){
                $query_update = mysqli_query($con, "UPDATE tabla_usuarios set nombre = '$nombre',nombre_empresa = '$nombre_empresa',cif = '$cif', direccion = '$direccion' ,email = '$email', password = '$password' WHERE id = '$id' ");
                
                if($query_update){
                    echo"<script>window.location.href='usuariosConfirmados.php';</script>";
                }else{
                    echo "Actualización fallida";
                
                }
            }else{
                echo "El correo o el cif pertenece a otro usuario";
            }   
        } 
} 

?>

    <!-- Vista del Modal de Rechazar Confirmados-->
<div class="container section">
    <div id="idModal" class="modal">
        <div class="modal-content">
            <h2 style="text-align:center;padding-top:20px;color:orange;">RECHAZAR USUARIO</h2>
            <h5>¿Seguro que quieres rechazar el siguiente usuario?</h5>
            <p><strong>Nombre: </strong><span><?php echo $nombre?></span></p>
            <p><strong>Nombre de Empresa:  </strong><span><?php echo $nombre_empresa?></span></p>
            <p><strong>Cif: </strong><span><?php echo $cif?></span></p>
            <p><strong>Dirección: </strong><span><?php echo $direccion?></span></p>
            <p><strong>Email: </strong><span><?php echo $email?></span></p>

            <a class="btn modal-close red" href="usuariosConfirmados.php">Cancelar</a>
            <button class="btn waves-effect waves-light green" type="submit" name="btnDelete">Aceptar</button>
        </div>

        <div class="modal-footer"> 
            <form method="post" action="">
                <a class="btn modal-close red" href="usuariosConfirmados.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnDelete">Aceptar</button>
            </form>
        </div>

    </div>
</div>
<?php
// Boton Rechazar dentro del modal

 if(isset($_POST['btnDelete']))
 {
    $query_delete = "DELETE from tabla_usuarios WHERE id = $id";
    $result = mysqli_query($con, $query_delete);
     if($query_delete){
        echo"<script>window.location.href='usuariosConfirmados.php';</script>";
        }else{
        echo "Error al rechazar";
     }
 }
?>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!--Configuración del Modal -->
<script>
    
    document.addEventListener('DOMContentLoaded', function(){
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
        
    });
</script>
</html>