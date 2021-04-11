<?php
require_once '../helpers/utilities.php';
require_once 'serviceSession.php';
require_once 'ServiceCookies.php';
require_once 'estudiante.php';

$service = new ServiceCookies();

    if(isset($_POST["EstudianteName"]) && isset($_POST["EstudianteApellido"]) && isset($_POST["EstudianteCarrera"]) && isset($_POST["EstudianteMateria"]) ){
    
  

        $estudiante = new Estudiante(0,$_POST["EstudianteName"],$_POST["EstudianteApellido"],$_POST["EstudianteCarrera"],$_POST["EstudianteMateria"], true);
        $service->Add($estudiante);

        header("Location: ../index.php");
    }

?>