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

if (isset($_POST["estudianteId"]) && isset($_POST["EstudianteName"]) && isset($_POST["EstudianteApellido"]) && isset($_POST["EstudianteCarrera"]) && isset($_POST["EstudianteMateria"]) && isset($_FILES["profilePhoto"])) {

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
        <h2>Lamentablemente, no existe este estudiante</h2>
        <?php var_dump($estudiante) ?>
    
    <?php else : ?>

        <form enctype="mulitpart/form-data" action="edit.php" method="POST">

                <input type="hidden" name="estudianteId" value="<?=  $estudiante->Id ?>">
                    <div class="mb-3">
                        <label for="estudiante-name" class="form-label">Nombre del estudiante</label>
                        <input name="EstudianteName" value="<?php echo $estudiante->Nombre ?>" type="text" class="form-control" id="estudiante-name">

                    </div>
                    <div class="mb-3">
                        <label for="estudiante-apellido" class="form-label">Apellido del estudiante</label>
                        <input name="EstudianteApellido" value="<?php echo $estudiante->Apellido ?>" type="text" class="form-control" id="estudiante-apellido">
                    </div>

                    <div class="mb-3">
                        <label for="estudiante-carrera" class="form-label">Carrera del estudiante</label>
                        <select name="EstudianteCarrera" class="form-select" id="estudiante-carrera">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($utilities->carreras as $valor => $texto) : ?>

                                <?php if ($valor == $estudiante->Carrera) : ?>
                            <option selected value="<?php echo $valor; ?>"> <?= $texto ?> </option>
                        <?php else : ?>
                            <option value="<?php echo $valor; ?>"> <?= $texto ?> </option>
                        <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
            </div>

            <div class ="mb-3">     
                    <label for="estudiante-materias" class="form-label">Materias Favoritas</label>
                        <input name="EstudianteMateria" value=" <?= $estudiante->Materias?>" type="text" class="form-control" id="estudiante-materias">
                     
            </div>



            


            <div class="mb-3">
            <?php if($estudiante->profilePhoto == "" || $estudiante->profilePhoto == null ): ?>

<img class="bd-placeholder-img card-img-top" src="<?php echo "../assets/img/vacia.gif" ?>" width="100%" height="225" aria-label="Placeholder: Thumbanil">
<?php else: ?>
<img class="bd-placeholder-img card-img-top" src="<?php echo "../assets/img/estudiantes/" . $estudiante->profilePhoto; ?>" width="100%" height="225" aria-label="Placeholder: Thumbanil">
<?php endif; ?>

        <div class="mb-3">
                    <label for="photo" class="form-label">Foto de perfil: </label>
                    <input name="profilePhoto" type="file" class="form-control" id="photo">
                </div>    
                </div>

                <div class="form-check">
                <?php if($estudiante->Status): ?>                        
                        <input class="form-check-input" type="radio" name="Estado" value="activo" name="flexRadioDefault" id="flexRadioDefault2" checked>

                    <?php else: ?>

                        <input class="form-check-input" type="radio" name="Estado" value="activo"  id="exampleRadios1"  >

                    <?php endif;?>

                
                    <label class="form-check-label" for="flexCheckChecked">
                        Activo
                    </label>

                </div>
               
                
                    <?php if($estudiante->Status): ?>                        
                        <input class="form-check-input" type="radio" name="Estado" value="Inactivo" name="flexRadioDefault" id="flexRadioDefault2" >

                    <?php else: ?>

                        <input class="form-check-input" type="radio" name="Estado" value="Inactivo"  id="exampleRadios1"   checked >

                    <?php endif;?>
                
                    <label class="form-check-label" for="flexCheckChecked">
                        Inactivo
                    </label>

                </div>

            




            <div class="col-md-3">
            <a href="../index.php" class="btn btn-warning">Volver atras </a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>




    <?php echo $layout->printFooter() ?>

</body>

</html>