<?php

namespace Deg540\ReservasRestaurante;

class Reservas
{
    private array $reservas;

    const string COMANDO_RESERVAR = "reservar";

    const string MENSAJE_RESERVA_NUMERO_POSTIIVO = "El numero de reserva debe ser un numero positivo";


    public function __construct(){
        $this->reservas = [];
    }

    public function ejecutar(string $accion):string{
        [$comando, $nombre, $numero] = $this->obtenerParametros($accion);
        if(array_key_exists($nombre, $this->reservas)){
            return "La reserva ya existe";
        }
        if($comando === self::COMANDO_RESERVAR){
            return $this->reservar($nombre, $numero);
        }
        return $this->listaReservas();
    }

    private function obtenerParametros(string $accion):array{
        $separado = explode(" ", $accion);
        return [strtolower($separado[0]), strtolower($separado[1]), $separado[2]];
    }

    private function listaReservas():string{
        $devolucionReservas = [];
        foreach($this->reservas as $nombre => $numero){
            $devolucionReservas[] = "$nombre x$numero";
        }
        return implode(", ", $devolucionReservas);
    }
    private function reservar(string $nombre, int $numero):string{
        if($numero < 0){
            return self::MENSAJE_RESERVA_NUMERO_POSTIIVO;
        }
        $this->reservas[$nombre] = $numero;
        return $this->listaReservas();
    }
}