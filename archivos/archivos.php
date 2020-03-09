<?php

class archivos{
/**
 * Esta función genera el archivo JSON necesario para guardar los datos
 */
    public function crearUsuariosJson($arr_clientes)
    {  
        try {
           //Creamos el JSON
            $json_string = json_encode($arr_clientes);
            $file = 'usuarios.json';
            file_put_contents($file, $json_string);
            return true;
        } catch (Exception $e) {
            echo "Erro creando el archivo JSON", $e->getMessage(), "\n";
            return false;
        }
        
    }
    /**
     * Esta funcion es la encargada de cargar los datos en el JSON
     */
    public function cargar($obj,$data)
    {
        try {
            $array = array();
            if($data!=null){
                foreach ($data as $value) {
                    array_push($array,$value);
                }
            }
            array_push($array,$obj);
            
           if (!$this->validaArchivoExiste($obj->getPath())) {
               echo "El archivo no existe";
               return false;
           }
           //abro el archivo 
            $file = fopen($obj->getPath(),"w");
            $json_string = json_encode($array);
           if (fwrite($file,$json_string)<=0) {
               return false;
           }
           //Valido que haya una img cargada
           if ($this->validarImgExiste($obj->getImg())) {
               //cargar la img
                if (!$this->cargarImg($obj->img)) {
                    echo "Error cargando imagen";
                    return false;
                }
           }
           
           return true;
        } catch (Exception $e) {
            echo "Error en la craga de los datos", $e->getMessage(), "\n";
            return false;
        }
    }
    /**
     * Esta funcion valida la existencia del archivo
     * retorna true si el archivo existe, de lo contrario retorna false.
     */
    public function validaArchivoExiste($path)
    {
        try {
            if (!file_exists($path)) {
                return false;
            } 
            return true;
        } catch (Exception $e) {
            echo "Error validando si  archivo existe", $e->getMessage(), "\n";
            return false;
        }
    }
/**
 *Esta funcion valida que el $_FILES['imagen']['name'] este cargado.
 */
    public function validarImgExiste($imgName)
    {
        try {
            if ($imgName == null) {
                echo "no hay imagenes cargadas";
                return false;
            }
            return true;
        } catch (Exception $e) {
            echo "Error validando si la imagen existe", $e->getMessage(), "\n";
            return false;
        }
    }
    /**
     * Esta funcion se encarga de cargar la imagen
     */
    public function cargarImg($imgName)
    {
        $origen = $_FILES['img']['tmp_name'];
        $destino = "img/" . $imgName;
        
        if (move_uploaded_file($origen,$destino)) {
            echo "imagen cargada";
            return true;
        }
        return false;
    }
}