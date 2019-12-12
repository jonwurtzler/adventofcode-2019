<?php

namespace Advent\CrossedWires;

class GridAxis
{
    const HORIZONTIAL = 'h';
    const VERTICAL    = 'v';

    /**
     * List of starting rows/columns for quick reference
     *
     * @var int[]
     */
    private array $homePoints;

    /**
     * @var string
     */
    private string $orientation;

    /**
     * List of all paths based on homePoints
     *
     * @var int[][]
     */
    private array $paths;

    public function __construct($orientation)
    {
        $this->orientation = $orientation;
    }

    public function setPath(int $homePoint, int $start, int $length): void
    {
        // Make sure we add in our home point for checking intersections quickly
        $this->addHomePoint($homePoint);

        $newPath = new Path($start, $start + $length);
        $this->paths[$homePoint][] = $newPath;
    }

    public function outputGrid(): array
    {
        $output = [];

        /**
         * @var int    $home
         * @var Path[] $paths
         */
        foreach ($this->paths as $home => $paths) {
            foreach ($paths as $path) {
                $output[$home][] = (string) $path;
            }
        }

        return $output;
    }

    private function addHomePoint($homePoint)
    {
        if (!isset($this->homePoints[$homePoint])) {
            $this->homePoints[] = $homePoint;
        }

        return $this;
    }

}
