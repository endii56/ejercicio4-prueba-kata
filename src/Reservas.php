<?php

namespace Deg540\ReservasRestaurante;

class Reservas
{
    private array $reservas;

    public function __construct(){
        $this->reservas = [];
    }

    public function ejecutar(string $accion):string{
        $separado = explode(" ", $accion);
        $comando = $separado[0];
        $nombre = $separado[1];
        $numero = $separado[2];
        if($comando === "reservar"){
            $this->reservas[$nombre] = $numero;
        }
        if(empty($this->reservas)){
            return "";
        }
        $devolucionReservas = [];
        foreach($this->reservas as $nombre => $numero){
            $devolucionReservas[] = "$nombre x$numero";
        }
        return implode(", ", $devolucionReservas);
    }
}