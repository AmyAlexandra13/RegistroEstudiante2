<?php

 class ServiceSession{   

    private $sessionName;

    private $utilities;

    public function __construct(){
        session_start();
        $this->sessionName = "estudianteLista";
        $this->utilities = new Utilities();
    }

    public function Add($item){

        $estudiantes = $this->GetList();

        if(count($estudiantes) == 0){
            $item->Id = 1;
        }else{

            $lastElement = $this->utilities->getLastElement($estudiantes);

            $item->Id = $lastElement->Id + 1;
        }      

        array_push($estudiantes, $item);

       $_SESSION[$this->sessionName] = $estudiantes;         
    }

    public function Edit($item){      

        $estudiantes = $this->GetList();
        
        $index = $this->utilities->getIndexElement($estudiantes,"Id",$item->Id);

        if($index !== null){
            $estudiantes[$index] = $item;
            $_SESSION[$this->sessionName] = $estudiantes;    
        }             
    }

    public function Delete($id){
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes,"Id",$id);

        if(count($estudiantes) > 0){
            unset($estudiantes[$index]);
            $_SESSION[$this->sessionName] = $estudiantes;  
        }
    }

    public function GetById($id){

        $estudiantes = $this->GetList();

        $estudiante = $this->utilities->searchProperty($estudiantes,"Id",$id);     
        
        return  $estudiante[0];
    }



    public function GetList(){

        $estudiantes = isset($_SESSION[ $this->sessionName]) ? $_SESSION[ $this->sessionName] : [];
        
        return  $estudiantes;

    }

    
   
}


?>



