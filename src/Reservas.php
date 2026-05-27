<?php

namespace Deg540\ReservasRestaurante;

class Reservas
{
    private array $reservas;

    public function __construct(){
        $this->reservas = [];
    }

    public function ejecutar(string $accion):string{
        if(empty($this->reservas)){
            return "";
        }
        return "no esta vacio";
    }
}