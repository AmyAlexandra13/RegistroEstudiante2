<?php
require_once 'estudiante.php';
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'serviceSession.php';
require_once 'ServiceCookies.php';



$layout = new Layout();
$service = new ServiceCookies();
$utilities = new Utilities();

$estudiante = null;

if (isset($_GET["id"])) {

    $estudiante = $service->GetById($_GET["id"]);
}

if (isset($_POST["estudianteId"]) && isset($_POST["EstudianteName"]) && isset($_POST["EstudianteApellido"]) && isset($_POST["EstudianteCarrera"]) && isset($_POST["EstudianteMateria"])) {

    $status = ($_POST["Status"] == "activo") ? true : false;

    $estudiante = new Estudiante($_POST["estudianteId"], $_POST["EstudianteName"], $_POST["EstudianteApellido"], $_POST["EstudianteCarrera"], $_POST["EstudianteMateria"], $status);

    $service->Edit($estudiante);

    header("Location: ../index.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <?php echo $layout->printHeader() ?>

    <?php if ( $estudiante == null) : ?>
        <h2>No hay detalles por ver</h2>
    <?php else : ?>

        <form action="edit.php" method="POST">
        <div class="col-md-2">  </div>
      <div class="col-md-10"> 

      <div class="card">
  
  <div class="card-header bg-success">
  <h3 class="text-left card-title">Ver detalles</h3>
</div>
            <input type="hidden" name="estudianteId" value="<?=  $estudiante->Id ?>">
            <div class="card-body">


            <?php if($estudiante->profilePhoto == "" || $estudiante->profilePhoto == null ): ?>

<img class="bd-placeholder-img card-img-top" src="<?php echo "../assets/img/vacia.gif" ?>" width="100%" height="225" aria-label="Placeholder: Thumbanil">
<?php else: ?>
<img class="bd-placeholder-img card-img-top" src="<?php echo "../assets/img/estudiantes/" . $estudiante->profilePhoto; ?>" width="100%" height="225" aria-label="Placeholder: Thumbanil">
<?php endif; ?>


          <ul class="list-group list-group-flush">
            <li class="list-group-item">Nombre: <?php echo $estudiante->Nombre ?> </li>
            <li class="list-group-item">Apellido: <?php echo $estudiante->Apellido ?></li>
           
            <?php  $separa= $estudiante->Materias?>
            <p class="card-text"> Materias favoritas </p>
                    <?php  $uno= explode(",",$separa) ?>
                    <?php foreach ($uno as $valor) : ?>
                        <p class="card-text"><?= $valor ?></p>
                    <?php endforeach; ?>
                    <p style="text-align: right" class="card-text">
                   
            
           
            <?php foreach ($utilities->carreras as $valor => $texto) : ?>
                <?php if ($valor == $estudiante->Carrera) : ?>
<li class="list-group-item">Carrera: <?= $texto ?> </li>
<?php endif; ?>
<?php endforeach; ?>


<?php if($estudiante->Status == "activo"): ?>
   
   <li class="list-group-item text-success">Estado: Activo</li>
 
 <?php else :?>
 
     <li class="list-group-item text-danger">Estado: Inactivo</span>
 
 <?php endif;?>
 <p class="card-text">







          </ul>
         
    
        </div>

        
            </div>

         
            </div>
            <a href="../index.php" class="btn btn-warning">Volver atras </a>
           
        </form>

    <?php endif; ?>




    <?php echo $layout->printFooter() ?>

</body>

</html>