<?php
/** 
 * La diferencia entre require y include, esta sijeta al tratamiento del error.
 * include permite que el codigo siga ejecutandose y mostrara un warning, pero require detiene la 
 * ejecucion mostrando un fatal error.
 * */   
include ("./entidades/usuario.php");
include ("./entidades/DAO.php");
include ("./archivos/archivos.php");
$path = 'C:\xampp\htdocs\backend\proys\PHP\PP\usuarios.json';
$DAO = new DAO();
$imgName = $_FILES['img']['name'];
echo $imgName;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST["tipo"]) {
        case 'alta':
            $usuario = new usuario($_POST["legajo"],$_POST["email"],$_POST["nombre"],$_POST["clave"],$imgName,$path);
            if (!$DAO->Alta($usuario,$path)) {
                echo "Ya esta registrado o el archivo no existe!!!";
               } else {
                   echo "Alta exitosa";
               }
            break;
        
        default:
            # code...
            break;
    }
  
} else {
    # code...
}

