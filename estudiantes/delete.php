<?php

require_once 'estudiante.php';
require_once '../helpers/utilities.php';
require_once 'serviceSession.php';
require_once 'ServiceCookies.php';

$service = new ServiceCookies();

    $contieneID = isset($_GET["id"]);

    if($contieneID){

        $service->Delete($_GET["id"]);
    }

    header("Location: ../index.php");
    exit();
?>