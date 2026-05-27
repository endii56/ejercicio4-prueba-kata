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

    /**
     * @test
     */
    public function testCancelarUnaReservaNoExistente():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("cancelar paco");

        $this->assertEquals("La reserva seleccionada no existe", $respuesta);
    }

    /**
     * @test
     */
    public function testCancelarUnaReservaExistenteEnMayusculas():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $respuesta = $controlador->ejecutar("cancelar PACO");

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testComandoCancelarEnMayusculasDebeTratarseIgualQueEnMinusculas():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $respuesta = $controlador->ejecutar("CANCELAR paco");

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testTrasErrorCancelandoSeDebePoderSeguirAñadiendoReservas():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("cancelar paco");
        $respuesta = $controlador->ejecutar("reservar paco 5");

        $this->assertEquals("paco x5", $respuesta);
    }

    /**
     * @test
     */
    public function testVaciarReservas():void
    {
        $controlador = new Reservas();

        $controlador->ejecutar("reservar paco 4");
        $respuesta = $controlador->ejecutar("vaciar");

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testReservarCon0Personas():void
    {
        $controlador = new Reservas();

        $respuesta = $controlador->ejecutar("reservar paco 0");

        $this->assertEquals("El numero de reserva debe ser un numero positivo", $respuesta);
    }
}