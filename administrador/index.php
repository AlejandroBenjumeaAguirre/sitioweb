<?php
if($_POST){
    header('Location:inicio.php');
}

?>

<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
            <br><br><br>
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header text-center">
                        Login
                    </div>
                    <div class="card-body">
                        
                        <form method="POST">

                        <div class = "form-group">
                        <label for="exampleInputEmail1">Usuario</label>

                        <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                        <small id="emailHelp" class="form-text text-muted">Por favor ingrese el usuario.</small>
                        </div>

                        <div class="form-group">

                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-dark">Entrar</button>

                        </form>
                        
                        
                    </div>
                </div>

            </div>
            
        </div>
    </div>
  </body>
</html>