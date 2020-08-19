<?php

namespace App\Model\Tennis;

/**
 * Class Magazine
 * @package App\Model\Tennis
 */
class Container {
    /**
     * @var int
     */
    public $size;

    /**
     * @var bool
     */
    public $is_verified;

    /**
     * @var array
     */
    public $ball;

    /**
     * Magazine constructor.
     *
     * @param int $size
     */
    public function __construct(int $size) {
        $this->size = $size;
        $this->is_verified = false;
        $this->ball = [];
    }
}
