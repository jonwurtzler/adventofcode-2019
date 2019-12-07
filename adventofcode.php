<?php
/**
 * Advent of Code 2016 - http://adventofcode.com/2016
 *
 * Usage: php adventofcode.php
 *
 * @author Jon Wurtzler <jon.wurtzler@gmail.com>
 * @date 01/04/2017
 */

use Advent\BathroomCodes;
use Advent\BunnyHQ;
use Advent\RealRooms;
use Advent\RepetitionCodes;
use Advent\SecurityCode;
use Advent\ValidDesigns;

require_once __DIR__ . '/vendor/autoload.php';

$adventString = (string) isset($argv[1]) ? $argv[1] : "";
$adventDay    = null;

switch ($adventString) {
    case 'fuel_req':
        $adventDay = new \Advent\RequiredFuel();
        break;
    case 'program_alarm':
        $adventDay = new \Advent\ProgramAlarm();
        break;

}

if (!is_null($adventDay)) {
  $adventDay->display();
} else {
  echo ("Invalid option, please try again\n");
}
