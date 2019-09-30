<?php
require "alumno.php";
require "alumnoDao.php";
require "materia.php";
require "materiaDao.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' )
{   

    $opt = $_POST['opt'];
switch ($opt) {
    case 'cargarAlumno':
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $path = $_FILES["imagen"]["name"];
            $email = $_POST['email'];
        $obj = new alumno($nombre,$apellido,$path,$email);
        if(alumnoDao::Guardar($obj))
        {
            echo "ALTA CORRECTA";
        }
        else
        {
            echo "ALTA INCORRECTA";
        }
        break;
    
    case 'cargarMateria':
    $nombre = $_POST['materia'];
    $codigoMateria = $_POST['codigoMateria'];
    $cupoAlumnos = $_POST['cupoAlumnos'];
    $aula = $_POST['aula'];
    $materia = new materia($nombre,$codigoMateria,$cupoAlumnos,$aula);
    if( materiaDao::Guardar($materia))
    {
        echo "ALTA CORRECTA";
    }
    else {
        echo "ALTA INCORRECTA";
    }
    break;
    case 'modificarAlumno':
        $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $path = $_FILES["imagen"]["name"];
            $email = $_POST['email'];
            
        $obj =new alumno($nombre,$apellido,$path,$email);
        if(materiaDao::modificarAlumno($obj))
        {
            echo "Alumno modificado";
        }
        else {
            echo "error modificacion";
        }
        break;
        
        break;
    default:
        # code...
        break;
}

}
else 
{   $opt = $_GET['opt'];
    switch ($opt) {
        case 'consultarAlumno':
        $apellido = $_GET['apellido'];
             
            if(!alumnoDao::consultarAlumno($apellido))
            {
                echo "No existe alumno con apellido"." ".$apellido;
            }
            
            break;
        case 'inscribirAlumno':
        $email = $_GET['email'];
        $codigoMateria = $_GET['codigoMateria'];
            materiaDao::inscribirAlumno($email,$codigoMateria);
            break;
            case 'inscripcionesTabla':
                materiaDao::tablaMateriaAlumno();
            break;
            case 'filtrar':
            materiaDao::filtrarTabla($_GET['filtro']);
            break;
            case 'alumnoImg':
            materiaDao::ImprimirAlumnos();
        default:
            # code...
            break;
    }
}