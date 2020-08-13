<?php

namespace App\Model\Game;

class Coordinate {

    /**
     * @var int
     */
    public int $x;

    /**
     * @var int
     */
    public int $y;

    /**
     * Coordinate constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function setLocation(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString() {
        return $this->x . ',' . $this->y;
    }
}
