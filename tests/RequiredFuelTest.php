<?php

use Advent\RequiredFuel;
use PHPUnit\Framework\TestCase;

class RequiredFuelTest extends TestCase
{
    /**
     * @var RequiredFuel
     */
    private $requiredFuel;

    public function setUp(): void
    {
        $this->requiredFuel = new RequiredFuel();
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testRequiredFuelTC1()
    {
        $this->assertEquals(2, $this->requiredFuel->calculateRequiredFuel(12));
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testRequiredFuelTC2()
    {
        $this->assertEquals(2, $this->requiredFuel->calculateRequiredFuel(14));
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testRequiredFuelTC3()
    {
        $this->assertEquals(654, $this->requiredFuel->calculateRequiredFuel(1969));
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testRequiredFuelTC4()
    {
        $this->assertEquals(33583, $this->requiredFuel->calculateRequiredFuel(100756));
    }

    /** Part Two  **/
    public function testRequiredFuelStep2TC1()
    {
        $this->assertEquals(2, $this->requiredFuel->calculateRequiredFuel(14, true));
    }

    public function testRequiredFuelStep2TC2()
    {
        $this->assertEquals(966, $this->requiredFuel->calculateRequiredFuel(1969, true));
    }

    public function testRequiredFuelStep2TC3()
    {
        $this->assertEquals(50346, $this->requiredFuel->calculateRequiredFuel(100756, true));
    }

}
