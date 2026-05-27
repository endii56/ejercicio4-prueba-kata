<?php

namespace Deg540\ReservasRestaurante\Test;

use PHPUnit\Framework\TestCase;
use Deg540\ReservasRestaurante\Reservas;
class ReservasTest extends TestCase
{
    /**
     * @test
     */
    public function testCrearReservasVacio():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("");

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testCrearUnaReserva():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("reservar paco 4");

        $this->assertEquals("paco x4", $respuesta);
    }

    /**
     * @test
     */
    public function testCrearUnaReservaConMayusculasDebeAlmacenarseEnMinusculas():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("reservar PACO 4");

        $this->assertEquals("paco x4", $respuesta);
    }

    /**
     * @test
     */
    public function testRecibirComandoReservarEnMayusculas():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("RESERVAR paco 4");

        $this->assertEquals("paco x4", $respuesta);
    }
}