<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <header>
        <?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb" ?>

        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="<?php echo $url."/administrador/inicio.php" ?>">Administrador<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo $url."/administrador/inicio.php" ?>">Inicio</a>
                <a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/productos.php" ?>">Libros</a>
                <a class="nav-item nav-link" href="<?php echo $url ?>">Ver sitio web</a>
                <a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/cerrar.php" ?>">Cerrar sección</a>
            </div>
        </nav>
    </header>
    
    <main class="container">
    <br>
        <section class="row">