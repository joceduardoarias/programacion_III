<?php

class DAO{
    /**
     * Funcion que se encarga de dar alta un objeto y lo guarda en un JSON
     * - Depende el identificador defenido valdia que el objeto no este dos veces.
     */
    public function Alta($obj,$path)
    {   
        try {
            //verifico que el archivo exista
            $archivos = new archivos();
            if (!$archivos->validaArchivoExiste($path)) {
                return false;
            }
            //Leemos el JSON
            $datos_usuarios = file_get_contents("usuarios.json");
            $json_usuarios = json_decode($datos_usuarios, true);
            //Valido que tengo o no datos cagados
            if ($json_usuarios != null) {
                //validar existencia del obj
                if ($this->validarExiste($obj,$json_usuarios)) {
                    return false;
                }
            //En este pundo ya se puede dar de alta
                if ($archivos->cargar($obj,$json_usuarios)) {
                    return false;
                }
            } else {
                //Si no hay datos cargados que lo cargue directamente
                if (!$archivos->cargar($obj,$json_usuarios)) {
                    return false;
                }
            }

            return true;
        } catch (Exception $e) {
            echo "Erro realizando el Alta", $e->getMessage(), "\n";
            return false;
        }
        
    }
    /**
     * Esta funcion validar la existencia del objeto.
     * Si este existe retornara true, de lo contrario retornara false.
     */
    public function validarExiste($obj,$data)
    {
        try {

            foreach ($data as $value) {
                //obj existe
                if ($value["legajo"]==$obj->legajo){
                    return true;
                }
               
            }
            //obj no existe
            return false;
        } catch (Exception $e) {
            echo "Error validar si existe ", $e->getMessage(), "\n";
        }
    }
   
}
