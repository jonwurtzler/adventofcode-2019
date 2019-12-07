<?php

namespace Advent;

use DataLoader;

class ProgramAlarm implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = '1202ProgramAlarm.txt';

    /**
     * @return void
     * @throws \Exception
     */
    public function display()
    {
        $program = $this->runProgram('1,1,1,4,99,5,6,0,99', true);
        echo $program . "\n";
        die;

        $input = DataLoader::loadFileAsArrayData($this->dataFile);

        $program = $this->runProgram($input[0], false);

        echo (sprintf('Part 1: Int at Index 0: %d of full Program: ', $program[0], implode(',', $program)) . "\n");
    }

    /**
     * @param string $input
     *
     * @return int[]|int
     */
    public function runProgram($input, $returnSingle = true)
    {
        $program = explode(',', $input);

        $index = 0;
        while (isset($program[$index])) {
            $this->runCommand($program, $index);

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
     * @return void
     */
    public function runCommand(&$program, $index = 0)
    {
        $opCode      = $program[$index];
        $numOne      = isset($program[$index + 1]) ? $program[$index + 1] : 0;
        $numTwo      = isset($program[$index + 2]) ? $program[$index + 2] : 0;
        $resultIndex = isset($program[$index + 3]) ? $program[$index + 3] : 0;

        switch ($opCode) {
            case 1:
                $program[$resultIndex] = $program[$numOne] + $program[$numTwo];
                break;
            case 2:
                $program[$resultIndex] = $program[$numOne] * $program[$numTwo];
                break;
            case 99:
                break;
        }
    }

}
