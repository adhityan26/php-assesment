<?php

namespace App\Model\Game;

/**
 * Class Ground
 * @package App\Model\Game
 */
class Ground {

    /**
     * @var Coordinate
     */
    public Coordinate $coordinate;

    /**
     * @var array
     */
    public array $map;

    /**
     * @var array
     */
    public array $possibleKeyLocation;

    /**
     * Coordinate constructor.
     *
     * @param Coordinate $startPosition
     * @param array $map
     */
    public function __construct(Coordinate $startPosition, array $map)
    {
        $this->coordinate = $startPosition;
        $this->map = $map;
        $this->possibleKeyLocation = [];
    }

    /**
     * Joni move forward based on Andi clue's
     *
     * @param string $direction
     * @param bool $possibility
     * @param array $history
     * @return bool
     */
    public function possibleLocation(string $direction, bool $possibility, array &$history) {
        if ($direction === 'n') {
            $canMoveEast = false;
            $canMoveNorth = true;
            if ($this->moveNorth()) {
                $history['n'] = new Coordinate($this->coordinate->x, $this->coordinate->y);
                $canMoveEast = $this->possibleLocation('e', $possibility, $history);
            } else {
                $canMoveNorth = false;
            }

            if ($canMoveEast === false && $canMoveNorth === false) {
                return true;
            }

            $this->possibleLocation('n', $possibility, $history);
        } else {
            if ($direction === 'e') {
                $canMoveSouth = false;
                $canMoveEast = true;
                if ($this->moveEast()) {
                    $history['e'] = new Coordinate($this->coordinate->x, $this->coordinate->y);
                    $canMoveSouth = $this->possibleLocation('s', $possibility, $history);
                } else {
                    $canMoveEast = false;
                }

                if ($canMoveSouth) {
                    $lastIntersection = $history['e'];
                    $this->coordinate->setLocation($lastIntersection->x, $lastIntersection->y);
                }

                if ($canMoveSouth === false && $canMoveEast === false) {
                    $this->coordinate->setLocation($history['n']->x, $history['n']->y);
                    return false;
                }

                $this->possibleLocation('e', $possibility, $history);
            } else {
                if ($direction === 's') {
                    if ($this->moveSouth()) {
                        $this->possibleKeyLocation[] = new Coordinate($this->coordinate->x, $this->coordinate->y);
                        return $this->possibleLocation('s', true, $history);
                    } else {
                        if ($possibility) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }

    /**
     * Joni move to north by one step
     *
     * @return bool
     */
    public function moveNorth() {
        if ($this->validMove($this->coordinate->x, $this->coordinate->y - 1)) {
            $this->coordinate->y -= 1;
            return true;
        }
        return false;
    }

    /**
     * Joni move to east by one step
     *
     * @return bool
     */
    public function moveEast() {
        if ($this->validMove($this->coordinate->x + 1, $this->coordinate->y)) {
            $this->coordinate->x += 1;
            return true;
        }
        return false;
    }

    /**
     * Joni move to south by one step
     *
     * @return bool
     */
    public function moveSouth() {
        if ($this->validMove($this->coordinate->x, $this->coordinate->y + 1)) {
            $this->coordinate->y += 1;
            return true;
        }
        return false;
    }

    /**
     * Check if Joni can move or not on the direction
     *
     * @param int $x
     * @param int $y
     * @return bool
     */
    private function validMove(int $x, int $y) {
        return $x > -1 && $y > -1 && $y < count($this->map) && $x < count($this->map[$y]) && $this->map[$y][$x] === '.';
    }
}
