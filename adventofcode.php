<?php
/**
 * Advent of Code 2016 - http://adventofcode.com/2016
 *
 * Usage: php adventofcode.php
 *
 * @author Jon Wurtzler <jon.wurtzler@gmail.com>
 * @date 01/04/2017
 */

use Advent\CrossedWires;
use Advent\ProgramAlarm;
use Advent\RequiredFuel;

require_once __DIR__ . '/vendor/autoload.php';

$adventString = (string) isset($argv[1]) ? $argv[1] : "";
$adventDay    = null;

switch ($adventString) {
    case 'fuel_req':
        $adventDay = new RequiredFuel();
        break;
    case 'program_alarm':
        $adventDay = new ProgramAlarm();
        break;
    case 'crossed_wires':
        $adventDay = new CrossedWires();
        break;
}

if (!is_null($adventDay)) {
  $adventDay->display();
} else {
  echo ("Invalid option, please try again\n");
}
