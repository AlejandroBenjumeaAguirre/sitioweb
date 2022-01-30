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

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            if($tmpImagen!=""){
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->execute();
            header("location:productos.php");
            break;
        case "actualizar":
            //UPDATE `libros` SET `nombre` = 'Libro de PHP1', `imagen` = 'imagen1.jpg' WHERE `libros`.`id` = 1;
            $sentenciaSQL= $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();

            if($txtImagen!=""){

                $fecha= new DateTime();
                $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
                
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

                $sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
                $sentenciaSQL->bindParam(':id',$txtID);
                $sentenciaSQL->execute();
                $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){

                    if(file_exists("../../img/".$libro["imagen"])){
                        unlink("../../img/".$libro["imagen"]);
                    }

                }

                $sentenciaSQL= $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
                $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
            }
                header("location:productos.php");
            break;
        case "eliminar":
                header("location:productos.php");
            break;
        case "seleccionar":
            $sentenciaSQL= $conexion->prepare("SELECT * FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$libro['nombre'];
            $txtImagen=$libro['imagen'];

            break;
        case "borrar":

            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){

                if(file_exists("../../img/".$libro["imagen"])){
                    unlink("../../img/".$libro["imagen"]);
                }

            }

            $sentenciaSQL= $conexion->prepare("DELETE FROM libros WHERE id = :id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            header("location:productos.php");
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
                <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
                <label for="txtNombre">Nombre</label>
                <input required type="text" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
            </div>

            <div class = "form-group">

                <label for="txtImagen">Imagen:</label>
                <br/>
                <?php echo $txtImagen; ?>
                <br/>
                <?php if($txtImagen!=""){ ?>

                    <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="120" alt="">
                <?php } ?>

                <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
            </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="seleccionar") ? "disabled" : ""; ?> value="agregar" class="btn btn-success">Agregar</button>
                &nbsp;
                <button type="submit" name="accion" <?php echo ($accion!="seleccionar") ? "disabled" : ""; ?> value="actualizar" class="btn btn-primary">Actualizar</button>
                &nbsp;
                <button type="submit" name="accion"  <?php echo ($accion!="seleccionar") ? "disabled" : ""; ?> value="eliminar" class="btn btn-danger">Eliminar</button>
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
                
                <td>
                <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="80" alt="">
                
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>"/>

                        <input type="submit" name="accion" value="seleccionar" class="btn btn-primary"/>

                        <input type="submit" name="accion" value="borrar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<?php include('../template/pie.php'); ?>