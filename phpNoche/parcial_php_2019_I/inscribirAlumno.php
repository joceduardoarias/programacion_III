<?php

class inscribirAlumno
{
   public $nombre;
   public $apellido;
   public $email;
   public $materia;
   public $codigoMateria;

    public function __construct($nombre,$apellido,$email,$materia,$codigoMateria)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email=$email;
        $this->materia=$materia;
        $this->codigoMateria = $codigoMateria;
    }
}