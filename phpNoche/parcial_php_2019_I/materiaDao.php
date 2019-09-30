<?php
require_once "./materia.php";
require_once "./alumnoDao.php";
require_once "./alumno.php";
require_once "./inscribirAlumno.php";
class materiaDao
{
     public static function Guardar($obj)
    {
        $flag = false;
        $array = materiaDao::listarTodos();
        $archivo = fopen("materias.json","w");
        array_push($array,$obj);
        $json_string = json_encode($array);
         $cant = fwrite($archivo,$json_string);
       
         if($cant>0)
        {    
               $flag = true;
        }
        fclose($archivo);
        return $flag;
    }
    public static function listarTodos()
    {
        $archivo = fopen("./materias.json","r");
        $dato = fread($archivo,filesize("./materias.json"));
        fclose($archivo);
        return json_decode($dato);
    }
    public static function listarInscriptos()
    {
        $archivo = fopen("./inscripciones.json","r");
        $dato = fread($archivo,filesize("./inscripciones.json"));
        fclose($archivo);
        return json_decode($dato);
    }
    public static function inscribirAlumno($email,$codigoMateria)
    {
        //Nos faltaria restar el cupo(para eso hay que pasar a int lo que esta en string de numeros)
        //Buscar el alumno y retornarlo
        $p1 = materiaDao::BuscarAlumnoEmail($email);
            if($p1 != null)
            {
                //buscamos la materia
                $m1 = materiaDao::BuscarMateria($codigoMateria);
                if($m1!=null)
                {   
                    if($m1->cupoAlumnos>0)
                    {
                    //restar cupo
                    $m1->cupoAlumnos = $m1->cupoAlumnos-1;
                
                   materiaDao::ModificarMateria($m1);
                   
                    $inscribirAlumno = new inscribirAlumno($p1->nombre,$p1->apellido,$p1->email,$m1->materia,$m1->codigoMateria);
                    
                    $array = materiaDao::listarInscriptos();
                    array_push($array,$inscribirAlumno);
                    $archivo = fopen("inscripciones.json","w");
                    $json_string = json_encode($array);
                    $cant = fwrite($archivo,$json_string);
                
                    fclose($archivo);
                    echo "alumno inscripto correctamente";
                    }
                    else {
                    echo "sin cupo";
                    }

            }
                else 
                {
                    echo "materia  no existe";
                }   
                    
            }
            else
            {
                echo "Alumno ". $email." no existe";
            }
        
    }
    public static function BuscarAlumnoEmail($email)
    {
        $arrayAlumnos = alumnoDao::listarTodos();
        $alumno = null;
        for($i=0;$i<count($arrayAlumnos);$i++)
        {
            if($arrayAlumnos[$i]->email == $email)
            {
                $alumno = $arrayAlumnos[$i];
                break;
            }
        }
        return $alumno;
    }
    public static function BuscarMateria($codigoMateria)
    {
        $arrayMaterias = materiaDao::listarTodos();
        $materia = null;
        for($i=0;$i<count($arrayMaterias);$i++)
        {
            if($arrayMaterias[$i]->codigoMateria == $codigoMateria)
            {
                $materia = $arrayMaterias[$i];
                break;
            }
        }
        return $materia;
    }
    
     public static function ModificarMateria($m1)
    {
        $materias = materiaDao::listarTodos();

        $arrayMaterias = array();
        foreach ($materias as $key => $value) 
        {
            if($value->codigoMateria != $m1->codigoMateria)
            {
                array_push($arrayMaterias,$value);
            }
            else
            {
                array_push($arrayMaterias,$m1);
            }
        }
        $json_string = json_encode($arrayMaterias);
            $archivo = fopen("materias.json","w");
            $cant = fwrite($archivo,$json_string);
            if($cant>0)
            {   
                $flag = true;
            }
            fclose($archivo);
    }

    public static function tablaMateriaAlumno()
    {   
        
       
        $materias  = materiaDao::listarTodos();
        $alumnosInscriptos = materiaDao::listarInscriptos();
     //Encabezado de la tabla
        echo "
        <table>
         <th> Materia </th>
         <th> Nombre </th>
         <th> Apellido </th>
         <th> Email </th>
        ";
        foreach ($materias as $key => $materia) {
            //recorriendo materias
            foreach ($alumnosInscriptos as $key => $alumno) 
            {   //comparando materias y alumnos con esas materias f
                if($materia->codigoMateria == $alumno->codigoMateria)
                {   //cuerpo tabla
                    echo 
                    "<tr>
                    <td>$alumno->materia</td>
                    <td>$alumno->nombre</td>
                    <td>$alumno->apellido</td>
                    <td>$alumno->email</td>
                    </tr>";
                }
            }
        }
    }
    public static function filtrarTabla($valor)
    {   /* en esta parte de la funcion filtro por materia*/
        $flag = false;
        $materias  = materiaDao::listarTodos();
        $alumnosInscriptos = materiaDao::listarInscriptos();
        //Encabezado de la tabla
        echo "
        <table>
         
         <th> Nombre </th>
         <th> Apellido </th>
         <th> Email </th>
         <th> Materia </th>
        ";
        foreach ($materias as $key => $materia) 
        {
            if($valor == $materia->materia)
            {
                foreach ($alumnosInscriptos as $key => $alumno) 
                {
                    if($materia->codigoMateria == $alumno->codigoMateria)
                    {
                        echo 
                        "<tr>
                        <td>$alumno->nombre</td>
                        <td>$alumno->apellido</td>
                        <td>$alumno->email</td>
                        <td>$materia->materia</td>
                        </tr>";
                        $flag = true;
                    }
                    
                }
            }
        }
        //echo "</table>";
        /** este es el filtro por apellido */
       if(!$flag)
       {
            $alumnos = array();
            /*busco los alumnos inscriptos con el apellido ingresado y los
              guardo en array*/
            $alumnos = materiaDao::BuscarAlumnoApellido($valor);
            //traigo todas las materias
            $materias = materiaDao::listarTodos();
            //var_dump($materiasInscriptos);
                if(count($alumnos)>0)
                {   
                   foreach ($materias as $key => $materia) 
                   {    
                        foreach ($alumnos as $key => $alumno) 
                        {
                            if($alumno->codigoMateria == $materia->codigoMateria)
                            {
                                echo 
                                "<tr>
                                <td>$alumno->nombre</td>
                                <td>$alumno->apellido</td>
                                <td>$alumno->email</td>
                                <td>$materia->materia</td>
                                </tr>";
                            }
                        }
                   }
                   echo "</table>";   
                }
       }
            
                
    }
    /* esta funcion recibe el apellido del alumno inscripto y me retorna
        un array con los alumnos que coinciden con ese apellido
    */
     public static function BuscarAlumnoApellido($apellido)
        {
            $arrayAlumnos = materiaDao::listarInscriptos();
            $alumnos = array();
            for($i=0;$i<count($arrayAlumnos);$i++)
            {
                if($arrayAlumnos[$i]->apellido == $apellido)
                {
                    $alumno = $arrayAlumnos[$i];
                    array_push($alumnos,$alumno);
                }
            }
            return $alumnos;
        }
       public static function modificarAlumno($obj)
       {
           $alumnos = alumnoDao::listarTodos();
            $aux = array(); 
            $flag = false;
           foreach ($alumnos as $key => $alumno) 
           {
                if($alumno->email != $obj->email)
                {
                    array_push($aux,$alumno);
                }
                else 
                {
                    
                    //variable fecha actual
                    $fechaactual  = date("m.d.y"); 
                    
                    //copia la imagen original en img/ a backup/
                    copy("./img/".$alumno->path,"./backup/".$alumno->path);
                    //renombra la imagen en el la carpeta backup/
                    rename("./backup/".$alumno->path,"./backup/".$alumno->apellido.$fechaactual.".png");
                    //borra la imagen
                    unlink("./img/".$alumno->path);
                    //traigo la nueva imagen
                    $destino = "img/" . $_FILES["imagen"]["name"];
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
                    //modifico el alumno
                    $alumno->nombre = $obj->nombre;
                    $alumno->apellido = $obj->apellido;
                    $alumno->path = $obj->path;
                    //lo agrego al rray
                    array_push($aux,$alumno);
                }
           }
           $json_string = json_encode($aux);
           $archivo = fopen("alumno.json","w");
           $cant = fwrite($archivo,$json_string);
           if($cant>0)
           {   
               $flag = true;
           }
           fclose($archivo);
           return $flag;
       }
       public static function ImprimirAlumnos()
       {
           $alumnos= alumnoDao::listarTodos();
           echo "
           <table>
            <tr>
            <th> Nombre </th>
            <th> Apellido </th>
            <th> Email </th>
            <th> Picture </th>
           ";
            foreach ($alumnos as $key => $alumno) 
            {
                echo 
                "<tr>
                <td>$alumno->nombre</td>
                <td>$alumno->apellido</td>
                <td>$alumno->email</td>
                <td> <img style='width: 100px; height: 100px;' src='./img/$alumno->path'> </td>
                </tr>";

            }
            echo "</table>";
       }
}