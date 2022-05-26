<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel de control</title>

     <!-- Import Google Icon Font -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>
<body>

  <nav class="nav-wrapper Green 900">
    <div class="container">
        <a href="#" data-target="menu-responsive" class="sidenav-trigger">
          <i class="material-icons">menu</i>
        </a>
      <ul class=" left hide-on-med-and-down">
        <li><a href="inicio.php">INICIO</a></li>
        <li><a href="usuariosConfirmados.php">USUARIOS CONFIRMADOS</a></li>
        <li><a href="usuariosPendientes.php">USUARIOS PENDIENTES</a></li>
      </ul>
    </div>
</nav>

<ul class="sidenav" id="menu-responsive">
  <li><a href="inicio.php">INICIO</a></li>
  <li><a href="usuariosConfirmados.php">USUARIOS CONFIRMADOS</a></li>
  <li><a href="usuariosPendientes.php">USUARIOS PENDIENTES</a></li>
</ul>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
  
  document.addEventListener('DOMContentLoaded', function(){
    var elemes = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elemes);
  });

</script>
</body>
</html>