
<?php

class persona 
{
    public $nombre;
    public $dni;
    
    public function __construct($nombre,$dni)
    {
        $this->nombre = $nombre;
        $this->dni = $dni;    
    }

    public function saludar()
    {
        echo $this->nombre. " " .$this->dni;
    }

}