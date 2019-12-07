<?php

namespace Advent;

use DataLoader;

class RequiredFuel implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'requiredFuel.txt';

    /**
     * @return void
     * @throws \Exception
     */
    public function display()
    {
        $modules = DataLoader::loadFileAsArrayData($this->dataFile);

        $totalFuel    = 0;
        $totalModules = 0;
        foreach ($modules as $moduleMass) {
            $totalFuel += $this->calculateRequiredFuel($moduleMass);
            $totalModules++;
        }

        echo (sprintf('Part 1: Total Fuel needed for %d modules: %d', $totalModules, $totalFuel) . "\n");

        // Step 2
        $totalFuel2 = 0;
        foreach ($modules as $moduleMass) {
            $totalFuel2 += $this->calculateRequiredFuel($moduleMass, true);
        }

        echo (sprintf('Part 2: Total Fuel needed for %d modules: %d', $totalModules, $totalFuel2) . "\n");
    }

    /**
     * @param int $moduleMass
     *
     * @return int
     */
    public function calculateRequiredFuel($moduleMass, $calFuelMass = false)
    {
        $fuel = floor($moduleMass / 3) - 2;

        // Don't allow anything less than 0
        if ($fuel <= 0) {
            $fuel = 0;
        }

        // Calculate fuel needed for fuel
        if ($calFuelMass) {
            $fuel += $this->calculateFuelForFuel($fuel);
        }

        return $fuel;
    }

    /**
     * @param int $fuelMass
     *
     * @return int
     */
    public function calculateFuelForFuel($fuelMass)
    {
        if ($fuelMass <= 0) {
            return 0;
        }

        $fuel = 0;
        $fuel += $this->calculateRequiredFuel($fuelMass, true);

        return $fuel;
    }

}
