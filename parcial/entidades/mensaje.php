<?php

class mensaje
{
    public $id;
    public $mensaje;
    public $email;
    public $fecha;
    function __construct($id,$mensaje){
        $this->id = $id;
        $this->mensaje = $mensaje;
    }

}
