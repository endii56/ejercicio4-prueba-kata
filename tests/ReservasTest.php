<?php

namespace Deg540\ReservasRestaurante\Test;

use PHPUnit\Framework\TestCase;
use Deg540\ReservasRestaurante\Reservas;
class ReservasTest extends TestCase
{
    /**
     * @test
     */
    public function testHolaMundo():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->holaMundo();

        $this->assertEquals("Hola mundo", $respuesta);
    }

    /**
     * @test
     */
    public function testCrearReservasVacio():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("");

        $this->assertEquals("", $respuesta);
    }

}