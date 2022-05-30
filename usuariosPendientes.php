<?php
include "conexion.php";
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios pendientes</title>
    <link rel="stylesheet" type ="text/css" href="css/style-pending.css" screen = "all" />
</head>
<body>

<!-- Cabecera -->
<?php
    include("header.php");
?>
<!-- ...................... -->

    <h3 style="text-align:center;">LISTA DE USUARIOS PENDIENTES</h3>
    <div class="container">
        <?php
            $query = "SELECT * FROM tabla_usuarios WHERE tabla_usuarios.estado = 'Pendiente'";
            $result = mysqli_query($con, $query);
            $alert = '';
        ?>

        <table id="tablaConfirmados" class="striped grey lighten-1 centered responsive-table">
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
                <td>
                <button data-target="idModalAceptar" class="btn waves-effect waves-light btn modal-trigger green confirmbtn" type="submit">Confirmar<i class="material-icons right">check</i></button>
                <button data-target="idModal" class="btn waves-effect waves-light btn modal-trigger red deletebtn" type="submit">Rechazar<i class="material-icons right">delete</i></button>
                </td>
            </tr>
        </tbody>
        <?php
             echo $alert;
            }
            }else{
                echo '<p class="parrafo">No hay usuarios para confirmar</p>';
            }
            ?>

        </table>
    </div>

    <!-- Vista del Modal de Rechazar Pendientes-->
<div class="container section">
    <div id="idModal" class="modal">
        <div class="modal-content">
        <h2 style="text-align:center;padding-top:20px;color:orange;">RECHAZAR USUARIO</h2>
            <h5>¿Seguro que quieres rechazar el siguiente usuario?</h5>
            <form method="post" action="">
            <input type="hidden" name="id2" id="id2">
            <p><strong>Nombre: </strong><span id="nombre2"></span></p>
            <p><strong>Nombre de Empresa:  </strong><span id="nombre_empresa2"></span></p>
            <p><strong>Cif: </strong><span id="cif2"></span></p>
            <p><strong>Dirección: </strong><span id="direccion2"></span></p>
            <p><strong>Email: </strong><span id="email2"></span></p>
        </div>
        <div class="modal-footer"> 
        <form method="post" action="">
                <a class="btn modal-close red" href="usuariosPendientes.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnDelete">Aceptar</button>
        </form>
        </div>
    </div>
</div>
<!-- .......................................................... -->

 <!-- Vista del Modal de Aceptar Pendientes-->
 <div class="container section">
    <div id="idModalAceptar" class="modal">
        <div class="modal-content">
        <h2 style="text-align:center;padding-top:20px;color:orange;">ACEPTAR USUARIO</h2>
            <h5>¿Seguro que quieres aceptar el siguiente usuario?</h5>
            <p><strong>Nombre: </strong><span id="nombre"></span></p>
            <p><strong>Nombre de Empresa:  </strong><span id="nombre_empresa"></span></p>
            <p><strong>Cif: </strong><span id="cif"></span></p>
            <p><strong>Dirección: </strong><span id="direccion"></span></p>
            <p><strong>Email: </strong><span id="email"></span></p>
        </div>
        <div class="modal-footer"> 
            <form method="post" action="">
                <a class="btn modal-close red" href="usuariosPendientes.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnConfirm">Aceptar</button>
            </form>
        </div>
    </div>
</div>
<!-- .............................................. -->

<?php

// Boton Rechazar dentro del modal
 if(isset($_POST['btnDelete']))
 {
    $id = $_POST['id2'];
    $query_delete = "DELETE from tabla_usuarios WHERE id = $id";
    $result = mysqli_query($con, $query_delete);
     if($result){
        echo"<script>window.location.href='usuariosPendientes.php';</script>";
        }else{
        echo "Error al rechazar";
     }
 }

// Boton Confirmar dentro del Modal 
if(isset($_POST['btnConfirm'])){
    $id = $data['id'];
    $query_update ="UPDATE tabla_usuarios SET estado = 'Confirmado' WHERE id = $id";
    $result = mysqli_query($con,$query_update);
    if($query_update){
        echo"<script>window.location.href='usuariosPendientes.php';</script>";
        }else{
        echo "Error al aceptar ";
    }
 }
?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!-- ................................................................................................... -->

<!--Configuracion del Modal -->
<script>
    
    document.addEventListener('DOMContentLoaded', function(){
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

</script>
<!-- ...................................................... -->

<!-- Compiled and minified JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Mostrar los datos de los usuarios en los modals -->
<script> 
$(document).ready(function(){
    $('.confirmbtn').on('click', function(){

        $tr = $(this.closest('tr'));

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);

        $('#nombre').text(data[1]);
        $('#nombre_empresa').text(data[2]);
        $('#cif').text(data[3]);
        $('#direccion').text(data[4]);
        $('#email').text(data[5]);
    });

    $('.deletebtn').on('click', function(){

        $tr = $(this.closest('tr'));

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        console.log(data);
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