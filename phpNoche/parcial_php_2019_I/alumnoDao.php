<?php

require_once "./alumno.php";

class alumnoDao
{

    public static function Guardar($obj)
    {
        $flag = false;
        $array = alumnoDao::listarTodos();
        $archivo = fopen("alumno.json","w");
        array_push($array,$obj);
        $json_string = json_encode($array);
         $cant = fwrite($archivo,$json_string);
       
         if($cant>0)
        {    //cargar imagen
            $destino = "img/" . $_FILES["imagen"]["name"];
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino)) 
            {
               $flag = true;
            }
            
        }
        fclose($archivo);
        return $flag;
    }
    public static function listarTodos()
    {
        $archivo = fopen("./alumno.json","r");
        $dato = fread($archivo,filesize("./alumno.json"));
        fclose($archivo);
        return json_decode($dato);
    }
     public static function ConsultarAlumno($apellido)
    {
            $arrayAlumnos = alumnoDao::listarTodos();
            $arrayAux = array();
            $flag = false;
            foreach ($arrayAlumnos as $key => $value) 
            {
                if(strcasecmp($value->apellido,$apellido)==0 )
                {
                    array_push($arrayAux, $value);
                    $flag = true;
                }
            }
            if($flag)
            {
                foreach ($arrayAux as $key => $alumno) 
                {
                    echo $alumno->nombre." ".$alumno->apellido."\n";
                }
            }
            //json_encode($arrayAux);
            return $flag;
    }
}