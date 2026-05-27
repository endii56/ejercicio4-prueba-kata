<?php

namespace Deg540\ReservasRestaurante;

class Reservas
{
    private array $reservas;

    private const string COMANDO_RESERVAR = "reservar";
    private const string COMANDO_CANCELAR = "cancelar";
    private const string COMANDO_VACIAR = "vaciar";

    private const string MENSAJE_RESERVA_NUMERO_POSTIIVO = "El numero de reserva debe ser un numero positivo";
    private const string MENSAJE_RESERVA_YA_EXISTENTE = "La reserva ya existe";
    private const string MENSAJE_CANCELAR_RESERVA_NO_EXISTENTE = "La reserva seleccionada no existe";



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
        if($comando === self::COMANDO_VACIAR){
            $this->vaciar();
        }
        return $this->listaReservas();
    }

    private function obtenerParametros(string $accion):array{
        $separado = explode(" ", $accion);
        if(isset($separado[1])){
            $nombre = strtolower($separado[1]);
        }
        else{
            $nombre = "";
        }
        $numero = $separado[2] ?? "";
        return [strtolower($separado[0]), $nombre, $numero];
    }

    private function listaReservas():string{
        $devolucionReservas = [];
        ksort($this->reservas);
        foreach($this->reservas as $nombre => $numero){
            $devolucionReservas[] = "$nombre x$numero";
        }
        return implode(", ", $devolucionReservas);
    }
    private function reservar(string $nombre, string $numero):string{
        if((int)$numero < 0){
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

    private function vaciar():void{
        $this->reservas = [];
    }
}