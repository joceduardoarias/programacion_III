<?php

class usuario{

    
    // Definiendo atributos.
    
    public $email;
    public $clave;
    public $tipo;
    public $id;
    //Constructor

    function __construct($email,$clave,$tipo,$id){
        $this->email = $email;
        $this->clave = $clave;
        $this->tipo = $tipo;
        $this->id=$id;
    }


}