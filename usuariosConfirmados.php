<?php
include "conexion.php";
include "SED.php";
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
    include("header.php");
?>
<!-- .............. -->

<h3 style="text-align:center">LISTA DE USUARIOS CONFIRMADOS</h3>
<div class="container">
    <?php
        $query = "SELECT * FROM tabla_usuarios WHERE tabla_usuarios.estado = 'Confirmado'";
        $result = mysqli_query($con,$query);
        $alert = '';
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
                <th>Password</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php
        
        if($result){
           foreach($result as $data){
        ?>
        <tbody>
            <tr>
                <td><?php echo $data['id'] ?></td>
                <td><?php echo $data['nombre'] ?></td>
                <td><?php echo $data['nombre_empresa'] ?></td>
                <td><?php echo $data['cif'] ?></td>
                <td><?php echo $data['direccion'] ?></td>
                <td><?php echo $data['email'] ?></td>
                <?php 
                $pass= $data['password'];
                $encrypt_data = secure::decrypt($pass);
                ?>
                <td><?php echo $encrypt_data?></td>
                <td>
                    <button data-target="idModalEdit" class="btn waves-effect waves-light btn modal-trigger teal editbtn" type="submit">Editar<i class="material-icons right">edit</i></button>
                    <button data-target="idModal" class="btn waves-effect waves-light btn modal-trigger red deletebtn" type="submit">Rechazar<i class="material-icons right">delete</i></button>
                </td>
            </tr>
        </tbody>
        <?php
                echo $alert;
            }
            }else{
                echo "<p>No hay usuarios confirmados</p>";
            }
            ?>

    </table>
</div>

    <!-- Vista del Modal de Editar Confirmados-->
    
    <div class="container section">
    <div id="idModalEdit" class="modal">
        
    <div class="class_h2">
        <h2 style="font-weight:normal;text-align:center;padding-top:20px;color:orange;">EDITAR</h2>
    </div>

<div class = "container center">
   
        <form class="col s12" action="" method="POST">
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="input-field col s12">
                <input placeholder="Nombre" name="nombre" id="nombre" class="nombre" type="text" >
                <label for="nombre">Nombre</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Nombre de la empresa" name="nombre_empresa" id="nombre_empresa" type="text" >
            <label for="nombre_empresa">Nombre de la empresa</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="CIF" name="cif" id="cif" type="text" >
            <label for="cif">CIF</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Dirección" name="direccion" id="direccion" type="text" >
            <label for="direccion">Dirección</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Email" name="email" id="email" type="text" >
            <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input placeholder="Contraseña" name="password" id="password" type="text" >
            <label for="password">Contraseña</label>
            </div>
        </div>

        <div class="modal-footer"> 
            <form method="post" action="">
                <a class="btn modal-close red" href="usuariosConfirmados.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnUpdate">Actualizar</button>
            </form>
        </div>
    </div>
</div>
 <!-- ···················································································································································································· -->



    <!-- Vista del Modal de Rechazar Confirmados-->
<div class="container section">
    <div id="idModal" class="modal">
        <div class="modal-content">
        <form method="post" action="">
            <h1 style="text-align:center;padding-top:20px;color:orange;">RECHAZAR USUARIO</h1>
            <h5>¿Seguro que quieres rechazar el siguiente usuario?</h5>
            <input type="hidden" name="id2" id="id2">
            <p ><strong>Nombre: </strong><span id="nombre2"></span></p>
            <p><strong>Nombre de Empresa:  </strong><span id="nombre_empresa2"></span></p>
            <p><strong>Cif: </strong><span id="cif2"></span></p>
            <p><strong>Dirección: </strong><span id="direccion2"></span></p>
            <p><strong>Email: </strong><span id="email2"></span></p>
            
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
    
            $query_comprobar = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE cif = '$cif' and id != '$id' ");
            $result2 = mysqli_fetch_array($query_comprobar);
            

            $query_comprobar2 = mysqli_query($con,"SELECT * FROM tabla_usuarios WHERE email = '$email' and id != '$id' ");
            $result3 = mysqli_fetch_array($query_comprobar2);
            

            

            $patronCIF= "/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/";
            $patronPass = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/";
            if(!preg_match($patronCIF,$_POST['cif'])){
                $alert = '<div class="bar error"> <p class = "msg_error">El formato CIF no es válido</p> </div> <br>'; 
                echo $alert;           
            }else{
                if(!preg_match($patronPass,$_POST['password'])){
                    $alert = '<div class="bar error"> <p class = "msg_error">La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.</p> </div> <br>';            
                    echo $alert;
                }else{
                    if($result2 < 2 ){
                        if($result3 < 2){
                            $encrypt_password = secure::encrypt($password);
                            $query_update = mysqli_query($con, "UPDATE tabla_usuarios set nombre = '$nombre',nombre_empresa = '$nombre_empresa',cif = '$cif', direccion = '$direccion' ,email = '$email', password = '$encrypt_password' WHERE id = '$id' ");
                            if($query_update){
                                echo"<script>window.location.href='usuariosConfirmados.php';</script>";
                                var_dump($result2);
                                
                            }else{
                                echo "Actualización fallida";
                            }
                        }else{
                            echo "El correo pertenece a otro usuario <br>";
                        }
                       
                    }else{
                        echo "El cif pertenece a otro usuario <br>";
                        
                        echo $email;
                        var_dump($result3);
                        
                    }  
                }
            }
 
        } 
} 

?>

<?php
// Boton Rechazar dentro del modal

 if(isset($_POST['btnDelete']))
 {
   $id = $_POST['id2'];
    $query_delete = "DELETE  from tabla_usuarios WHERE id = $id";
    $result = mysqli_query($con,$query_delete);
     if($query_delete){
        echo"<script>window.location.href='usuariosConfirmados.php';</script>";
        }else{
        echo "Error al rechazar";
     }
 }
?>

</body>

<!-- Compiled and minified JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!--Configuracion del Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function(){
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);   
    });

</script>

<!-- Mostrar los datos de los usuarios en los modals --> 

<script> 
$(document).ready(function(){
    $('.editbtn').on('click', function(){

        $tr = $(this.closest('tr'));

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        //console.log(data);

        $('#id').val(data[0]);
        $('#nombre').val(data[1]);
        $('#nombre_empresa').val(data[2]);
        $('#cif').val(data[3]);
        $('#direccion').val(data[4]);
        $('#email').val(data[5]);
        $('#password').val(data[6]);
    });

    $('.deletebtn').on('click', function(){

        $tr = $(this.closest('tr'));

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $('#id2').val(data[0]);
        $('#nombre2').text(data[1]);
        $('#nombre_empresa2').text(data[2]);
        $('#cif2').text(data[3]);
        $('#direccion2').text(data[4]);
        $('#email2').text(data[5]);
    });
});
</script>

</html>