<?php include('../template/cabecera.php'); ?>

<?php 
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    
    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../config/bd.php');

    switch($accion){
        case "agregar":
            $sentenciaSQL= $conexion->prepare("INSERT INTO `libros` (nombre, imagen) VALUES (:nombre, :imagen);");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            $sentenciaSQL->bindParam(':imagen', $txtImagen);
            $sentenciaSQL->execute();
            break;
        case "actualizar":
            //UPDATE `libros` SET `nombre` = 'Libro de PHP1', `imagen` = 'imagen1.jpg' WHERE `libros`.`id` = 1;
            echo "actualizar";
            break;
        case "eliminar":
            echo "eliminar";
            break;
    }

    $sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listadelibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="col-md-5">

<div class="card">
    <div class="card-header">
        Datos del libro
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
                <label for="txtID">ID</label>
                <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre">
            </div>

            <div class = "form-group">
                <label for="txtImagen">Imagen</label>
                <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
            </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                &nbsp;
                <button type="submit" name="accion" value="actualizar" class="btn btn-primary">Actualizar</button>
                &nbsp;
                <button type="submit" name="accion"  value="eliminar" class="btn btn-danger">Eliminar</button>
            </div>

        </form>

    </div>
</div>

   
    
</section>

<section class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listadelibros as $libro){ ?>
            <tr>
                <td><?php echo $libro['id']; ?></td>
                <td><?php echo $libro['nombre']; ?></td>
                <td><?php echo $libro['imagen']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>"/>

                        <input type="submit" name="action" value="seleccionar" class="btn btn-primary"/>
                        <input type="submit" name="action" value="borrar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<?php include('../template/pie.php'); ?>