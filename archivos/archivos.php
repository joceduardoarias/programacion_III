<?php

class archivos{

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
            //abro el archivo
           if (!$this->validaArchivoExiste($obj->getPath())) {
               echo "El archivo no existe";
               return false;
           } 
            $file = fopen($obj->getPath(),"w");
            $json_string = json_encode($array);
           if (fwrite($file,$json_string)<=0) {
               return false;
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
}