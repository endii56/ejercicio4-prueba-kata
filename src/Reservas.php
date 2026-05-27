<?php

namespace Deg540\ReservasRestaurante;

class Reservas
{
    private array $reservas;

    const string COMANDO_RESERVAR = "reservar";
    const string COMANDO_CANCELAR = "cancelar";

    const string MENSAJE_RESERVA_NUMERO_POSTIIVO = "El numero de reserva debe ser un numero positivo";
    const string MENSAJE_RESERVA_YA_EXISTENTE = "La reserva ya existe";
    const string MENSAJE_CANCELAR_RESERVA_NO_EXISTENTE = "La reserva seleccionada no existe";



    public function __construct(){
        $this->reservas = [];
    }

    public function ejecutar(string $accion):string{
        [$comando, $nombre, $numero] = $this->obtenerParametros($accion);
        if($comando === self::COMANDO_RESERVAR){
            return $this->reservar($nombre, $numero);
        }
        if($comando === self::COMANDO_CANCELAR){
            return $this->cancelar($nombre);
        }
        return $this->listaReservas();
    }

    private function obtenerParametros(string $accion):array{
        $separado = explode(" ", $accion);
        $numero = $separado[2] ?? "";
        return [strtolower($separado[0]), strtolower($separado[1]), $numero];
    }

    private function listaReservas():string{
        $devolucionReservas = [];
        ksort($this->reservas);
        foreach($this->reservas as $nombre => $numero){
            $devolucionReservas[] = "$nombre x$numero";
        }
        return implode(", ", $devolucionReservas);
    }
    private function reservar(string $nombre, int $numero):string{
        if($numero < 0){
            return self::MENSAJE_RESERVA_NUMERO_POSTIIVO;
        }
        if(array_key_exists($nombre, $this->reservas)){
            return self::MENSAJE_RESERVA_YA_EXISTENTE;
        }
        $this->reservas[$nombre] = $numero;
        return $this->listaReservas();
    }

    private function cancelar(string $nombre):string{
        if(!array_key_exists($nombre, $this->reservas)){
            return self::MENSAJE_CANCELAR_RESERVA_NO_EXISTENTE;
        }
        unset($this->reservas[$nombre]);
        return $this->listaReservas();
    }
}