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
  * Como vemos, la variable “filename” incluirá el nombre del fichero en el que guardaremos 
  * la información y la variable “path” es la ruta en la cual situaremos el fichero. 
  * Estas variables son opcionales desde el constructor y si no le pasamos ningún valor tomarían 
  * el nombre de fichero “log” y la ruta de la carpeta donde está situado el script.
  */