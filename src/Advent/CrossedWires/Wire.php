<?php

namespace Advent\CrossedWires;

class Wire
{
    /**
     * @var Cursor
     */
    private Cursor $cursor;

    /**
     * @var GridAxis
     */
    private GridAxis $columnGrid;

    /**
     * @var GridAxis
     */
    private GridAxis $rowGrid;

    public function __construct()
    {
        $this->cursor     = new Cursor();
        $this->columnGrid = new GridAxis(GridAxis::VERTICAL);
        $this->rowGrid    = new GridAxis(GridAxis::HORIZONTIAL);
    }

    public function placePath($path)
    {
        $direction = $path[0];
        $distance  = (int) substr($path, 1);

        switch ($direction) {
            case Direction::DOWN:
                $distance *= -1;
            case Direction::UP:
                $this->moveWireVertical($distance);
                break;
            case Direction::LEFT:
                $distance *= -1;
            case Direction::RIGHT:
                $this->moveWireHorizontal($distance);
                break;
        }
    }

    public function outputGrids(): array
    {
        $output = [];
        $output['columns'] = $this->columnGrid->outputGrid();
        $output['rows']    = $this->rowGrid->outputGrid();

        return $output;
    }

    private function moveWireHorizontal(int $distance): void
    {
        $this->rowGrid
            ->setPath($this->cursor->getRow(), $this->cursor->getColumn(), $distance);

        // Update Cursor position
        $this->cursor->moveRow($distance);
    }

    private function moveWireVertical(int $distance): void
    {
        $this->columnGrid
            ->setPath($this->cursor->getColumn(), $this->cursor->getRow(), $distance);

        // Update Cursor position
        $this->cursor->moveColumn($distance);
    }

}
