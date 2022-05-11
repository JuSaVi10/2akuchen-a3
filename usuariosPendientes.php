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
                <a class="waves-effect waves-light btn green" href ="aceptar_usuarios.php?id=<?php echo $data['id'];?>"><i class="material-icons left">check</i>Confirmar</a>
                <a class="waves-effect waves-light btn red" href="eliminar_confirmados.php?id=<?php echo $data['id'];?>"><i class="material-icons left">delete</i>Rechazar</a>
                </td>
            </tr>
        </tbody>
        
        <?php
            }
            }else{
                echo "No hay usuarios pendientes";
            }
        ?>

    </table>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>