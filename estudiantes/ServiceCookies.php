<?php

 class ServiceCookies{   

    private $CookieName;

    private $utilities;

    public function __construct(){
            
        $this->CookieName = "estudianteLista";
        $this->utilities = new Utilities();
    }

    public function Add($item){

        $estudiantes = $this->GetList();
        $estudianteId = 1;

        if(!empty($estudiantes)){
            $lastElement = $this->utilities->getLastElement($estudiantes);

            $estudianteId = $lastElement->Id + 1;
        }
         
        $item->profilePhoto = "";
        $item->Id = $estudianteId;

        
        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){
                $item->profilePhoto = "";
        } else{

            $typeReplace = str_replace("image/","", $_FILES["profilePhoto"]["type"]);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $name =   $estudianteId . '.' . $typeReplace;
            $tmpname = $photoFile['tmp_name'];

            $success = $this->utilities->UploadImage('../assets/img/estudiantes/',$name,$tmpname,$type,$size);

            if($success){
                $item->profilePhoto = $name;

            }

        }
    }
    

        array_push($estudiantes, $item);        

        setcookie($this->CookieName,json_encode($estudiantes),$this->GetCookieTime(), "/");

    }

    public function Edit($item){      

        $estudiantes = $this->GetList();
        
        $index = $this->utilities->getIndexElement($estudiantes,"Id",$item->Id);



        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){
                    $item->profilePhoto = $index->profilePhoto;
            } else{
                $typeReplace = str_replace("image/","", $_FILES['profilePhoto']['type']);
                $type =  $photoFile['type'];
                $size =  $photoFile['size'];
                $name =  $index . '.' . $typeReplace;
                $tmpname =  $photoFile['tmp_name'];
    
                $success = $this->utilities->UploadImage('../assets/img/estudiantes/',$name,$tmpname,$type,$size);
    
                if($success){
                    $item->profilePhoto = $name;
    
                }

            }

           

        }

        if($index !== null){
            $estudiantes[$index] = $item;

            setcookie($this->CookieName,json_encode($estudiantes),$this->GetCookieTime(), "/");    
        }             
    }

    public function Delete($id){
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes,"Id",$id);

        if(count($estudiantes) > 0){
            unset($estudiantes[$index]);
            
            setcookie($this->CookieName,json_encode($estudiantes),$this->GetCookieTime(), "/");
        }
    }

    public function GetById($id){

        $estudiantes = $this->GetList();

        $estudiante = $this->utilities->searchProperty( $estudiantes,"Id",$id);     
        
        return  $estudiante[0];
    }

    public function GetList(){

       $estudiantes = array();

       if(isset($_COOKIE[$this->CookieName])){

        $estudiantes  =(array) json_decode($_COOKIE[$this->CookieName]); 

       }
       return $estudiantes;
    }

    private function GetCookieTime(){
        return time() + 60 * 60 * 24 * 30;
    }   
   
}


?>



