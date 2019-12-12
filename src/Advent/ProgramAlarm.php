<?php

namespace Advent;

use DataLoader;
use Exception;

class ProgramAlarm implements AdventOutputInterface
{
    private $debug = false;

    /**
     * Guess 1: 106699 -- To Low
     * Guess 2: 107699 -- To Low -random guess to get scope of diff
     * Guess 3: 207699 -- To Low -random guess to get scope after walking through every step and things look right.
     * I now realize I'm dumb and didn't read the instructions as fully as I should have. Missed replacing 1 and 2.
     * Guess 4: 4714701 -- Finally, got it.
     *
     * Part 2
     * Guess 1: 5121 -- Correct
     *
     * @var string
     */
    private $dataFile = '1202ProgramAlarm.txt';

    /**
     * @return void
     * @throws Exception
     */
    public function display()
    {
        $input   = DataLoader::loadFileAsArrayData($this->dataFile);
        $program = explode(',', $input[0]);

        // Replace the two numbers as per the instructions
        $program[1] = 12;
        $program[2] = 2;

        // Part 1
        $programAnswer = $this->runProgram($program, false);
        $programString = implode(',', $programAnswer);

        echo ("\n" . sprintf('Part 1: Int at Index 0: %d of full Program: %s', $programAnswer[0], $programString) . "\n\n");

        // Part 2
        $noun   = 0;
        $answer = 0;
        while ($noun < 100) {
            $verb = 0;
            while ($verb < 100) {
                // Set test values
                $program[1] = $noun;
                $program[2] = $verb;

                // Run and verify
                $programValue = $this->runProgram($program, true);

                if (19690720 === $programValue) {
                    $answer = 100 * $noun + $verb;
                    break 2;
                }

                $verb++;
            }
            $noun++;
        }

        echo (sprintf('Part 2: Noun - %s Verb - %s Answer - %s', $noun, $verb, $answer) . "\n\n");
    }

    /**
     * @param int[] $program
     *
     * @return int[]|int
     */
    public function runProgram($program, $returnSingle = true)
    {
        $index = 0;
        $terminateProgram = false;
        $stepCount = 1;
        while (!$terminateProgram) {
            if ($this->debug) {
                echo sprintf("Full Program at Step %d:\n", $stepCount);
                $this->outputCommandParts($program, 10);
            }

            $terminateProgram = $this->runCommand($program, $index);

            $index += 4;
            $stepCount++;
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

        if ($this->debug) {
            echo sprintf("Index: %s \n", $index);
            echo sprintf("Op Code: %s \n", $opCode);
            echo sprintf("Number 1: %s \n", $numOne);
            echo sprintf("Number 1 - Value: %s \n", $program[$numOne]);
            echo sprintf("Number 2: %s \n", $numTwo);
            echo sprintf("Number 2 - Value: %s \n", $program[$numTwo]);
            echo sprintf("Answer Index: %s \n", $resultIndex);
        }

        $newValue = 0;

        switch ($opCode) {
            case 1:
                $newValue = $program[$numOne] + $program[$numTwo];
                $program[$resultIndex] = $newValue;
                break;
            case 2:
                $newValue = $program[$numOne] * $program[$numTwo];
                $program[$resultIndex] = $newValue;
                break;
            case 99:
                return true;
        }

        if ($this->debug) {
            echo sprintf("New Value: %s \n\n", $newValue);
        }

        return false;
    }

    /**
     * Used for testing, just to give an output of the current array.
     *
     * @param int[] $program
     * @param int     $length
     *
     * @return void
     */
    public function outputCommandParts($program, $length)
    {
        $len = count($program);
        $index = 0;
        while ($index < $len) {
            $part = array_slice($program, $index, $length, true);
            echo $index . " - " . implode(',', $part) . "\n";
            $index += $length;
        }

        echo "\n";
    }

}
