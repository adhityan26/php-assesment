<?php

namespace App\Model\Soldier;

/**
 * Class Magazine
 * @package App\Model\Soldier
 */
class Magazine {
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
    public $ammo;

    /**
     * @var bool
     */
    public $is_tested;

    /**
     * Magazine constructor.
     *
     * @param int $size
     */
    public function __construct(int $size) {
        $this->size = $size;
        $this->is_verified = false;
        $this->ammo = [];
        $this->is_tested = null;
    }
}
