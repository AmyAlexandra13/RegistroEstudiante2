<?php

    class Utilities{

    public $carreras = [1=> "Software", 2=>"Redes", 3=>"Multimedia", 4=>"Mecatronica",5=>"Seguridad Informatica"];
 

    public function getLastElement($list){

        $countList = count($list);
        $lastElement = $list[$countList -1];

        return $lastElement;

    }

    public function searchProperty($list,$property,$value){

        $filters = [];

        foreach($list as $item){

            if($item->$property == $value){
                array_push($filters, $item);
            }
        }

        return $filters;
    }

    public function getIndexElement($list,$property,$value){

        foreach($list as $key => $item){

            if($item->$property == $value){             
                return $key;              
               
            }
        }
    }


    public function uploadImage($directory,$name,$tmpFIle,$type,$size){

        $isSuccess = false;

        if(($type == "image/gif") || ($type == "image/jpeg")|| ($type == "image/png")|| ($type == "image/jpg")|| ($type == "image/JPG")|| ($type == "image/pjpeg")&&($size  < 1000000)){

            if(!file_exists($directory)){

                mkdir($directory,0777,true);

                if(file_exists($directory)){

                    $this ->uploadFIle($directory . $name,$tmpFIle);
                    $isSuccess = true;
                }
            }else{

                $this ->uploadFIle($directory . $name,$tmpFIle);
                $isSuccess = true;

            }

        }else{
            $isSuccess =false;
        }
        return $isSuccess;
    }

    private function UploadFile($name, $tmpfile){
        if(file_exists($name)){
            unlink($name);
        }

            move_uploaded_file($tmpfile,$name);     
    }

    

}
