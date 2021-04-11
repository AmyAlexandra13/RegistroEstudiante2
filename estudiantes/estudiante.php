<?php

    class Estudiante{

        public $Id;
        public $Nombre;
        public $Apellido;
        public $Carrera;
        public $Materias;
        public $profilePhoto;
        public $Status;
       

        public function __construct($id, $nombre, $apellido, $carrera, $materias, $status)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->Carrera = $carrera;
            $this->Materias = $materias;
            //$this->$profilePhoto = $profilephoto;
            $this->Status = $status;

            
        }


    }

?>