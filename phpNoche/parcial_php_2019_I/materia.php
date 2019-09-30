<?php

class materia
{   
    public $materia;
    public $codigoMateria;
    public $cupoAlumnos;
    public $aula;

    public function __construct($materia,$codigoMateria,$cupoAlumnos,$aula)
    {
        $this->materia = $materia;
        $this->codigoMateria = $codigoMateria;
        $this->cupoAlumnos = intval($cupoAlumnos);
        $this->aula = $aula;
    }
}