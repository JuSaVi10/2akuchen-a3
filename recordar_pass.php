<?php


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type ="text/css" href="css/css.css" screen = "all" />

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Registro</title>
</head>
<div class = "container">
   
        <form id="registro" class="col s12" action="" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
            <input placeholder="Email" name="email" type="text" value="<?php echo $email?>">
            <label for="email">Email</label>
            </div>
        </div>
        <input type="submit" value="Recordar Contraseña" name="bbtn_registrar">

        <div class="row">
            <div class="col s12 m6 l4">
            <?php echo isset($alert) ? $alert : '' ?>
            </div>
        </div>
        
        </form>
    </div>
        
    

</body>
</html>
