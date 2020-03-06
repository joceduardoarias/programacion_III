<?php

class dao
{
    public static function Listar($obj)
    {   $flag = false;
        
        $array = array();
        array_push($array,$obj);
        echo "<p>" .json_encode($array). "</p>" ;
            for ($i=0; $i <count($array) ; $i++) 
            { 
                echo  $array[$i]->legajo." - ".$array[$i]->cuatrimestre." - ".$array[$i]->nombre." - ".$array[$i]->dni;
             }

    }

     public static function Guardar($obj)
    {   
        $array = array();
       
        array_push($array,$obj);
       
        json_encode($array);//escribiendo en formato json

        for ($i=0; $i <count($array) ; $i++) 
        { 
            echo  $array[$i]->legajo." - ".$array[$i]->cuatrimestre." - ".$array[$i]->nombre." - ".$array[$i]->dni;
         }
        
    }
public static function Borrar($obj3)
{    $array = array();
    array_push($array,$obj3);
    unset($obj3);
    var_dump($array);
    echo "eliminado";
     
}

}