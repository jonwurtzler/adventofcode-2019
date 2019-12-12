<?php

namespace Advent;

use Advent\CrossedWires\Wire;
use DataLoader;
use Exception;

class CrossedWires implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'crossedWires.txt';

    /**
     * @throws Exception
     */
    public function display()
    {
        $input   = DataLoader::loadFileAsArrayData($this->dataFile);
        $wire1Instructions = explode(',', $input[0]);
        $wire2Instructions = explode(',', $input[1]);

//        echo "Wire 1: " . $input[0] . "\n";
//        echo "Wire 2: " . $input[1] . "\n";
//
//        print_r($wire1Instructions);die;

        $wire1 = new Wire();
        $wire2 = new Wire();

        $this->populateWire($wire1, $wire1Instructions);
        $this->populateWire($wire2, $wire2Instructions);

        print_r($wire1->outputGrids());
    }

    private function populateWire(Wire $wire, array $instructions)
    {
        foreach ($instructions as $path) {
            $wire->placePath($path);
        }
    }

}
