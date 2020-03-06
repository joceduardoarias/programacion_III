<?php
require "./clases/persona.php";
 class alumno extends persona 
{
    public $legajo;
    public $cuatrimestre;

    public function __construct($legajo,$cuatrimestre,$nombre,$dni)
    {
        parent::__construct($nombre,$dni);
       $this->legajo = $legajo;
       $this->cuatrimestre = $cuatrimestre;
    }
    public function ToString()
    {
        echo $this->nombre. " " .$this->dni." ".$this->legajo." ".$this->cuatrimestre;
    }

   
}