<?php
require_once 'estudiantes/estudiante.php';
require_once 'helpers/utilities.php';
require_once 'estudiantes/serviceSession.php';
require_once 'estudiantes/ServiceCookies.php';
require_once 'layout/layout.php';

$layout = new Layout(true);
$service = new ServiceCookies();
$utilities = new Utilities();

$estudiantes = $service->GetList();


 if(!empty($estudiantes)){
     if(isset($_GET['filtro'])){

     $estudiantes = $utilities->searchProperty($estudiantes,'Carrera',$_GET['filtro']);
 }
 }
?>

<?php echo $layout->printHeader(); ?>

<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevo-heroe-modal">
            Nuevo estudiante
        </button>

    </div>
</div>
 

<div style="margin-bottom: 2%" class="row">

    <div class="col-md-0"></div>
    
    <div class="col-md-0">
        <div class="btn-group">
            <a href="index.php"  class="btn btn-primary text-light">Todos</a>
            <a href="index.php?filtro=1" class="btn btn-primary text-light">Software</a>
            <a href="index.php?filtro=2" class="btn btn-primary text-light">Redes</a>
            <a href="index.php?filtro=3" class="btn btn-primary text-light">Multimedia</a>
            <a href="index.php?filtro=4" class="btn btn-primary text-light">Mecatronica</a>
            <a href="index.php?filtro=5" class="btn btn-primary text-light">Seguridad Informatica</a>

        </div>
    </div>
</div>

<div class="row">

    <?php if (count($estudiantes) == 0) : ?>

        <h2>No hay estudiantes registrados</h2>

    <?php else : ?>

        <?php foreach ($estudiantes as $item => $estu) : ?>

            <div class="col-md-3">

                <div class="card">
                
                <?php if($estu->profilePhoto == "" || $estu->profilePhoto == null ): ?>

                    <img class="bd-placeholder-img card-img-top" src="<?php echo "assets/img/vacia.gif" ?>" width="100%" height="225" aria-label="Placeholder: Thumbanil">
                <?php else: ?>
                    <img class="bd-placeholder-img card-img-top" src="<?php echo "assets/img/estudiantes/" . $estu->profilePhoto; ?>" width="100%" height="225" aria-label="Placeholder: Thumbanil">
                <?php endif; ?>

 
               

                    <div class="card-body">
                        <h5 class="card-title"><?= $estu->Nombre ?></h5>
                        <p class="card-text"><?= $estu->Apellido ?></p>
                        <p class="card-text"><strong><?php echo $utilities->carreras[$estu->Carrera ] ?></strong></p>

                        <p class="card-text">

                        <strong>

                        <?php if($estu->Status == "activo"): ?>

                            <span class="text-success">Activo</span>

                        <?php else :?>

                            <span class="text-danger">Inactivo</span>

                        <?php endif;?>

                        </strong>

                        </p>

                    </div>

                    <div class="card-body">
                    <a href="estudiantes/ver.php?id=<?= $estu->Id ?>" class="btn btn-success">Ver</a>
                        <a href="estudiantes/edit2.php?id=<?= $estu->Id ?>" class="btn btn-primary">Editar</a>
                        <a href="#" data-id="<?= $estu->Id ?>" class="btn btn-danger btn-delete">Eliminar</a>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>



    <?php endif; ?>



</div>

<div class="modal fade" id="nuevo-heroe-modal" tabindex="-1" aria-labelledby="nuevoHeroeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoHeroeLabel">Nuevo estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form enctype="multipart/form-data" action="estudiantes/add.php" method="POST">
                    <div class="mb-3">
                        <label for="estudiante-name" class="form-label">Nombre del estudiante</label>
                        <input name="EstudianteName" type="text" class="form-control" id="estudiante-name">

                    </div>
                    <div class="mb-3">
                        <label for="estudiante-apellido" class="form-label">Apellido del estudiante</label>
                        <input name="EstudianteApellido" type="text" class="form-control" id="estudiante-apellido">
                    </div>
                    <div class="mb-3">
                        <label for="estudiante-carrera" class="form-label">Carrera del estudiante</label>
                        <select name="EstudianteCarrera" class="form-select" id="estudiante-carrera">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($utilities->carreras as $valor => $texto) : ?>

                                <option value="<?php echo $valor; ?>"> <?= $texto ?> </option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="estudiante-materias" class="form-label">Materias Favoritas</label>
                        <input name="EstudianteMateria" type="text" class="form-control" id="estudiante-materias">
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto de perfil: </label>
                        <input name="profilePhoto" type="file" class="form-control" id="photo">
                    </div>                   


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $layout->printFooter(); ?>

<script src="assets/js/site/index/index.js"></script>

