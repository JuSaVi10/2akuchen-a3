<?php
include "conexion.php";
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios confirmados</title>
    
</head>

<body>
<?php
    include("header.html");
?>

    <h3 style="text-align:center;">LISTA DE USUARIOS CONFIRMADOS</h3>
    <div class="container">
    <?php
        $query = mysqli_query($con, "SELECT tabla_usuarios.id,tabla_usuarios.nombre,tabla_usuarios.nombre_empresa,tabla_usuarios.cif,tabla_usuarios.direccion,tabla_usuarios.email,tabla_usuarios.password FROM tabla_usuarios WHERE tabla_usuarios.estado = 'Confirmado'");
        $result = mysqli_num_rows($query);
        
        if($result>0){
    ?>
    <table class="striped yellow darken-3 centered responsive-table">
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
                    <a class="waves-effect waves-light btn" href = "editar_confirmados.php?id=<?php echo $data['id'];?>"><i class="material-icons left">edit</i>Editar</a>
                    
                    <button href = "editar_confirmados.php?<?php echo $id = $data['id'];?>" data-target="idModal" class="btn waves-effect waves-light btn modal-trigger red" type="submit">Rechazar<i class="material-icons right">delete</i></button>
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
                    header("location: usuariosConfirmados.php");
                }
            }
            ?>
        </table>
    </div>
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
                <a class="btn modal-close red" href="usuariosConfirmados.php">Cancelar</a>
                <button class="btn waves-effect waves-light green" type="submit" name="btnDelete">Aceptar</button>
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
        echo"<script>window.location.href='usuariosConfirmados.php';</script>";

        }else{
        echo "Error al rechazar";
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