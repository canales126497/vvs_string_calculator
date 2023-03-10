<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use Deg540\PHPTestingBoilerplate\StringCalculatorTest1;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->calculadora = new StringCalculator();
    }
    /**
     * @test
     **/
    function returns0OnEmpty()
    {
        $suma_de_numeros = $this->calculadora->add("");

        $this->assertEquals(0, $suma_de_numeros);
    }

    /**
     * @test
     */
    function makesSumOf2Numbers()
    {
        $suma_de_numeros = $this->calculadora->add("1,2");

        $this->assertEquals(3, $suma_de_numeros);
    }

    /**
     * @test
     */
    function makesSumOf3Numbers()
    {
        $suma_de_numeros = $this->calculadora->add("1,2,2");

        $this->assertEquals(5, $suma_de_numeros);
    }

    /**
     * @test
     */
    function makesSumOfMoreThan3NUmbers()
    {
        $suma_de_numeros = $this->calculadora->add("1,2,3,4,5,6");

        $this->assertEquals(21, $suma_de_numeros);
    }

    /**
     * @test
     */
    function splitsByComaAndNewLine()
    {
        $suma_de_numeros = $this->calculadora->add("1\n2,3\n4,5,6");

        $this->assertEquals(21, $suma_de_numeros);
    }

    /**
     * @test
     */
    function allowsChangingDelimiter()
    {
        $suma_de_numeros = $this->calculadora->add("//;\n1\n2;3\n4;5;6");

        $this->assertEquals(21, $suma_de_numeros);
    }

    /**
     * @test
     */
    function negativeNumbersThrowException()
    {
        $this->expectExceptionMessage("negativos no soportados: -1, -3, -6");

        $this->calculadora->add("//;\n-1\n2;-3\n4;5;-6");
    }

    /**
     * @test
     */
    function ignoresNumbersAbobe1000()
    {
        $suma_de_numeros = $this->calculadora->add("2,1002");

        $this->assertEquals(2, $suma_de_numeros);
    }

    /**
     * @test
     */
    function anyLengthDelimiters()
    {
        $suma_de_numeros = $this->calculadora->add("//[]\n1\n2,3");

        $this->assertEquals(6, $suma_de_numeros);
    }
}
