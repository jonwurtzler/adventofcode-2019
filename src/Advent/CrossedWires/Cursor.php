<?php

namespace Advent\CrossedWires;

class Cursor
{
    /**
     * @var int
     */
    private int $column = 0;

    /**
     * @var int
     */
    private int $row = 0;

    public function getColumn(): int
    {
        return $this->column;
    }

    public function moveColumn(int $distance): self
    {
        $this->column += $distance;

        return $this;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function moveRow(int $distance): self
    {
        $this->row += $distance;

        return $this;
    }

    public function reset(): self
    {
        $this->column = 0;
        $this->row    = 0;

        return $this;
    }

}
