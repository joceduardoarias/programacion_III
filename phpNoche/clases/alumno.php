<?php
require "./clases/persona.php";
 class alumno extends persona 
{
    public $legajo;
    public $cuatrimestre;

    public function __contruct($legajo,$cuatrimestre,$nombre,$dni)
    {
        parent::__contruct($nombre,$dni);
       $this->legajo = $legajo;
       $this->cuatrimestre = $cuatrimestre;
    }
    public function saludar()
    {
        echo $this->nombre. " " .$this->dni." ".$this->legajo." ".$this->dni;
    }

}