<?php

namespace Advent;

use DataLoader;

class ProgramAlarm implements AdventOutputInterface
{
    /**
     * Guess 1: 106699 -- To Low
     *
     * @var string
     */
    private $dataFile = '1202ProgramAlarm.txt';

    /**
     * @return void
     * @throws \Exception
     */
    public function display()
    {
        $input = DataLoader::loadFileAsArrayData($this->dataFile);

        $program = $this->runProgram($input[0], false);
        $programString = implode(',', $program);

        echo (sprintf('Part 1: Int at Index 0: %d of full Program: %s', $program[0], $programString) . "\n");
    }

    /**
     * @param string $input
     *
     * @return int[]|int
     */
    public function runProgram($input, $returnSingle = true)
    {
        $program = explode(',', $input);

        $this->outputCommandParts($program);
        die;

        $index = 0;
        $terminateProgram = false;
        while (!$terminateProgram) {
            echo sprintf("Full Program at Step: %s \n", implode(',', $program));
            $terminateProgram = $this->runCommand($program, $index);

            $index += 4;
        }

        if ($returnSingle) {
            return $program[0];
        }

        return $program;
    }

    /**
     * @param int[] $program
     * @param int    $index
     *
     * @return bool
     */
    public function runCommand(&$program, $index = 0)
    {
        $opCode      = $program[$index];
        $numOne      = isset($program[$index + 1]) ? $program[$index + 1] : 0;
        $numTwo      = isset($program[$index + 2]) ? $program[$index + 2] : 0;
        $resultIndex = isset($program[$index + 3]) ? $program[$index + 3] : 0;

        echo sprintf("Index: %s \n", $index);
        echo sprintf("Op Code: %s \n", $opCode);
        echo sprintf("Number 1: %s \n", $numOne);
        echo sprintf("Number 1 - Value: %s \n", $program[$numOne]);
        echo sprintf("Number 2: %s \n", $numTwo);
        echo sprintf("Number 2 - Value: %s \n", $program[$numTwo]);
        echo sprintf("Answer Index: %s \n", $resultIndex);

        $newValue = 0;

        switch ($opCode) {
            case 1:
                $program[$resultIndex] = $program[$numOne] + $program[$numTwo];
                $newValue = $program[$numOne] + $program[$numTwo];
                break;
            case 2:
                $program[$resultIndex] = $program[$numOne] * $program[$numTwo];
                $newValue = $program[$numOne] * $program[$numTwo];
                break;
            case 99:
                return true;
        }

        echo sprintf("New Value: %s \n\n", $newValue);

        return false;
    }

    public function outputCommandParts($program)
    {
        $len = count($program);
        $index = 0;
        while ($index < $len) {
            $part = array_slice($program, $index, 4);
            echo implode(',', $part) . "\n";
            $index += 4;
        }
    }

}
