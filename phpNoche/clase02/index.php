<?php
require_once "./clases/dao.php";
require_once "./clases/alumno.php";


$request = $_SERVER['REQUEST_METHOD'];




switch ($request) {
    case 'POST':
    $obj = new alumno($_POST['legajo'],$_POST['cuatrimestre'],$_POST['nombre'],$_POST['dni']);
    echo "<p> GUARDAR </p>";
    dao::Guardar($obj);
       
        break;
    case 'GET':
    $obj2 = new alumno ($_GET['legajo'],$_GET['cuatrimestre'],$_GET['nombre'],$_GET['dni']);
    echo "<p> LISTAR </p>";
    dao::Listar($obj2);
        break;
        case 'DELETE':
        
        $obj3 = new alumno($_GET['legajo'],$_GET['cuatrimestre'],$_GET['nombre'],$_GET['dni']);
        
        dao::Borrar($obj3);
        break;
    default:
        break;
}


