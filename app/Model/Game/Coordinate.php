<?php

namespace App\Model\Game;

/**
 * Class Coordinate
 * @package App\Model\Game
 */
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

    /**
     * @param int $x
     * @param int $y
     */
    public function setLocation(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->x . ',' . $this->y;
    }
}
