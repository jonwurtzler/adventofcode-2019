<?php

namespace Advent\CrossedWires;

class Path
{
    /**
     * @var int
     */
    private int $end;

    /**
     * @var int
     */
    private int $start;

    public function __construct($start = 0, $end = 0)
    {
        $this->start = $start;
        $this->end   = $end;
    }

    public function __toString()
    {
        return sprintf('%s|%s', $this->start, $this->end);
    }

    public function getEnd(): int
    {
        return $this->end;
    }

    public function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function isBefore(int $startCheck): bool
    {
        if ($startCheck <= $this->start) {
            return true;
        }

        return false;
    }

    public function isAfter(int $endCheck): bool
    {
        if ($endCheck >= $this->end) {
            return true;
        }

        return false;
    }

    public function containsPath(int $checkStart, int $checkEnd): bool
    {
        if ($checkStart >= $this->start && $checkEnd <= $this->end) {
            return true;
        }

        return false;
    }

}
