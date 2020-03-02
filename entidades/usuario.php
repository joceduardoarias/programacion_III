<?php

class usuario{

    
    // Definiendo propiedades.
    
    public $legajo;
    public $email;
    public $nombre;
    public $clave;
    public $img;
    public $path;
    //Constructor

    function __construct($legajo,$email,$nombre,$clave,$img,$path){
        $this->legajo = $legajo;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->img = $img;
        $this->path = $path;
    }

    //Getters

    public function getLegajo()
    {
        return $this->legajo;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getImg()
    {
        return $this->img;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getClave()
    {
        return $this->$clave;
    }
}