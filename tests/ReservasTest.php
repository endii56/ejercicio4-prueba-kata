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

    /**
     * @test
     */
    public function testRecibirNumeroNegativoMensajeError():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("reservar paco -2");

        $this->assertEquals("El numero de reserva debe ser un numero positivo", $respuesta);
    }

    /**
     * @test
     */
    public function testReservarCuandoLaReservaConEseNombreYaExiste():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $respuesta = $controlador->ejecutar("reservar paco 5");

        $this->assertEquals("La reserva ya existe", $respuesta);

    }

    /**
     * @test
     */
    public function testRealizarDosReservas():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar ana 4");
        $respuesta = $controlador->ejecutar("reservar paco 4");

        $this->assertEquals("ana x4, paco x4", $respuesta);
    }

    /**
     * @test
     */
    public function testLasReservasDebenEstarOrdenadasAlfabeticamente():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $respuesta = $controlador->ejecutar("reservar ana 4");

        $this->assertEquals("ana x4, paco x4", $respuesta);
    }

    /**
     * @test
     */
    public function testTrasReservarErroneamenteSePuedeSeguirReservando():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $controlador->ejecutar("reservar paco 6");
        $respuesta = $controlador->ejecutar("reservar zoila 4");

        $this->assertEquals("paco x4, zoila x4", $respuesta);
    }

    /**
     * @test
     */
    public function testCancelarUnaReserva():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $respuesta = $controlador->ejecutar("cancelar paco");

        $this->assertEquals("", $respuesta);
    }
}