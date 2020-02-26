<?php

class Log{

    public function __construct($filename, $path)
    {
    $this->path     = ($path) ? $path : "/";
    $this->filename = ($filename) ? $filename : "log";
    $this->date     = date("Y-m-d H:i:s");
    $this->ip       = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0;
    }

}
/**
 * http://www.codigoactionscript.org/generar-archivos-log-desde-php/
 */

 /**
  * Como vemos, la variable �filename� incluir� el nombre del fichero en el que guardaremos 
  * la informaci�n y la variable �path� es la ruta en la cual situaremos el fichero. 
  * Estas variables son opcionales desde el constructor y si no le pasamos ning�n valor tomar�an 
  * el nombre de fichero �log� y la ruta de la carpeta donde est� situado el script.
  */