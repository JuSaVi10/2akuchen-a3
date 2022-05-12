<?php
include "conexion.php";
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios pendientes</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    
<?php
    include("header.html");
?>
    <h3 style="text-align:center;">LISTA DE USUARIOS PENDIENTES</h3>
    <div class="container">
        <?php
            $query = mysqli_query($con, "SELECT tabla_usuarios.id,tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email,tabla_usuarios.password FROM tabla_usuarios WHERE tabla_usuarios.estado = 'Pendiente'");
            $result = mysqli_num_rows($query);
            
            if($result>0){
        ?>
        <table class="striped grey lighten-1 centered responsive-table">
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
                <td><?php echo $data['password'] ?></td>
                <td>
                <!-- <a class="waves-effect waves-light btn green" href ="aceptar_usuarios.php?id=<?php echo $data['id'];?>"><i class="material-icons left">check</i>Confirmar</a> -->
                <button href = "usuariosPendientes.php?<?php echo $id = $data['id'];?>" data-target="idModalAceptar" class="btn waves-effect waves-light btn modal-trigger green" type="submit">Confirmar<i class="material-icons right">check</i></button>
                <button href = "usuariosPendientes.php?<?php echo $id = $data['id'];?>" data-target="idModal" class="btn waves-effect waves-light btn modal-trigger red" type="submit">Rechazar<i class="material-icons right">delete</i></button>

                </td>
            </tr>
        </tbody>
        
        <?php
            }
            }else{
                echo "No hay usuarios para confirmar";
            }

            if($result>0){
            $query = "SELECT tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email,tabla_usuarios.estado FROM tabla_usuarios WHERE tabla_usuarios.id = $id";
            $resultado = mysqli_query($con, $query);
            $num_row = mysqli_num_rows($resultado);
                if($num_row>0){
                    while( $data = mysqli_fetch_array($resultado)){
                        $nombre = $data['nombre'];
                        $nombre_empresa = $data['nombre_empresa'];
                        $cif = $data['cif'];
                        $direccion = $data['direccion'];
                        $email = $data['email'];
                    }
                }else{
                    header("location: usuariosPendientes.php");
                }
            }
            ?>
        </table>
    </div>

    <!-- Vista del Modal de Rechazar Pendientes-->
<div class="container section">
    <div id="idModal" class="modal">
        <div class="modal-content">
            <h1>Rechazar Usuario</h1>
            <h2>¿Seguro que quieres rechazar el siguiente usuario?</h2>
            <p><strong>Nombre: </strong><span><?php echo $nombre?></span></p>
            <p><strong>Nombre de Empresa:  </strong><span><?php echo $nombre_empresa?></span></p>
            <p><strong>Cif: </strong><span><?php echo $cif?></span></p>
            <p><strong>Dirección: </strong><span><?php echo $direccion?></span></p>
            <p><strong>Email: </strong><span><?php echo $email?></span></p>
        </div>
        <div class="modal-footer"> 
            <form method="post" action="">
                <a class="btn modal-close red" href="usuariosPendientes.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnDelete">Aceptar</button>
            </form>
        </div>
    </div>
</div>


 <!-- Vista del Modal de Aceptar Pendientes-->
 <div class="container section">
    <div id="idModalAceptar" class="modal">
        <div class="modal-content">
            <h1>Aceptar usuario</h1>
            <h2>¿Seguro que quieres aceptar el siguiente usuario?</h2>
            <p><strong>Nombre: </strong><span><?php echo $nombre?></span></p>
            <p><strong>Nombre de Empresa:  </strong><span><?php echo $nombre_empresa?></span></p>
            <p><strong>Cif: </strong><span><?php echo $cif?></span></p>
            <p><strong>Dirección: </strong><span><?php echo $direccion?></span></p>
            <p><strong>Email: </strong><span><?php echo $email?></span></p>
        </div>
        <div class="modal-footer"> 
            <form method="post" action="">
                <a class="btn modal-close red" href="usuariosPendientes.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnConfirm">Aceptar</button>
            </form>
        </div>
    </div>
</div>

<?php
 if(isset($_POST['btnDelete']))
 {
    $query_delete = "DELETE from tabla_usuarios WHERE id = $id";
    $result = mysqli_query($con, $query_delete);
     if($query_delete){
        echo"<script>window.location.href='usuariosPendientes.php';</script>";
        }else{
        echo "Error al rechazar";
     }
 }

 if(isset($_POST['btnConfirm'])){
    $query_update ="UPDATE tabla_usuarios SET estado = 'Confirmado' WHERE id =$id";
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

<!--Configuracion del Modal -->
<script>
    
    document.addEventListener('DOMContentLoaded', function(){
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
        
    });

</script>

</html>