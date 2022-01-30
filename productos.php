<?php include("./template/cabecera.php");?>

<?php 
include("administrador/config/bd.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listadelibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <?php foreach($listadelibros as $libro) { ?>
    <div class="col-md-3">
    
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" alt="">

            <div class="card-body">
                <h4 class="card-title"><?php echo $libro['nombre']; ?></h4>
                <a name="" id="" class="btn btn-primary" href="#" role="button"> Ver más </a>
            </div>

        </div>
    </div>
   <?php } ?>
</div>

<?php include("./template/pie.php"); ?>