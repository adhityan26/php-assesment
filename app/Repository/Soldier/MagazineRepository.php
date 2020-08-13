<?php

namespace App\Repository\Soldier;

use App\Model\Soldier\Magazine;
use Illuminate\Support\Facades\Cache;
use Exception;

class MagazineRepository {
    public $magazines;

    function __construct() {
        $this->magazines = Cache::get('magazines');
    }

    /**
     * Put magazine into cache storage
     */
    private function saveMagazines() {
        Cache::forever('magazines', $this->magazines);
    }

    /**
     * Initialize magazine with parameter or previously saved parameter
     *
     * @param int|null $count
     * @param int|null $size
     * @return array
     */
    public function initMagazines(int $count = null, int $size = null) {
        Cache::forget('magazines');
        if ($size != null) {
            Cache::forever('magazineSize', $size);
        } else {
            $size = Cache::get('magazineSize');
        }
        if ($count != null) {
            Cache::forever('magazineNumber', $count);
        } else {
            $count = Cache::get('magazineNumber');
        }
        $this->magazines = [];
        for ($i = 0; $i < $count; $i++) {
            $this->magazines[] = new Magazine($size);
        }

        $this->saveMagazines();

        return $this->magazines;
    }

    /**
     * put an ammo into a magazine by it's index
     *
     * @param int $index
     * @return mixed
     */
    public function putAmmo(int $index) {
        $this->magazines[$index]->ammo[] = 0;
        if (count($this->magazines[$index]->ammo) === $this->magazines[$index]->size) {
            $this->magazines[$index]->is_verified = true;
        }
        $this->saveMagazines();

        return $this->magazines[$index];
    }

    /**
     * Find verified magazine and return it's index
     *
     * @param bool $ignoreError
     * @return false|int|string
     * @throws Exception
     */
    public function verifiedMagazine(bool $ignoreError = false) {
        $magazines = Cache::get('magazines');

        $verifiedIndex = array_search(true, array_column($magazines, 'is_verified'));

        if (!$ignoreError && $verifiedIndex > -1) {
            throw new Exception("Magazine " . $verifiedIndex . " is already full");
        }

        return array_search(true, array_column($magazines, 'is_verified'));
    }

    /**
     * Test the verified magazine
     *
     * @return false|int|string
     * @throws Exception
     */
    public function testMagazine() {
        $index = $this->verifiedMagazine(true);

        if ($this->magazines[$index]->is_tested) {
            throw new Exception('Magazine ' . $index . ' already tested');
        }
        array_pop($this->magazines[$index]->ammo);
        $this->magazines[$index]->is_tested = true;
        $this->saveMagazines();

        return $index;
    }
}
