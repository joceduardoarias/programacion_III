<?php

class alumno
{
    public $nombre;
    public $apellido;
    public $path;
    public $email;

    public function __construct($nombre,$apellido,$path,$email)
    {
       $this->nombre = $nombre;
       $this->apellido = $apellido;
       $this->path=$path;
       $this->email=$email;
    }
    public function ToString()
    {
        echo $this->nombre. " " .$this->apellido." ".$this->paht." ".$this->email;
    }
}
