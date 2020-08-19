<?php

namespace App\Repository\Tennis;

use App\Model\Tennis\Container;
use Illuminate\Support\Facades\Cache;
use Exception;

/**
 * Class ContainerRepository
 * @package App\Repository\Tennis
 */
class ContainerRepository {

    /**
     * @var array|mixed
     */
    public array $container;

    function __construct() {
        $this->container = Cache::get('container') ?? [];
    }

    /**
     * Put container into cache storage
     */
    private function saveContainers() {
        Cache::forever('container', $this->container);
    }

    /**
     * Initialize container with parameter or previously saved parameter
     *
     * @param int|null $count
     * @param int|null $size
     * @return array
     * @throws Exception
     */
    public function initContainers(int $count = null, int $size = null) {
        Cache::forget('container');
        if ($size != null) {
            Cache::forever('containerSize', $size);
        } else {
            $size = Cache::get('containerSize');
        }
        if ($count != null) {
            Cache::forever('containerNumber', $count);
        } else {
            $count = Cache::get('containerNumber');
        }

        if ($count < 1) {
            throw new Exception('Container count must be greater than 0');
        }

        if ($size < 1) {
            throw new Exception('Container count must be greater than 0');
        }
        $this->container = [];
        for ($i = 0; $i < $count; $i++) {
            $this->container[] = new Container($size);
        }

        $this->saveContainers();

        return $this->container;
    }

    /**
     * put an ball into a container by it's index
     *
     * @param int $index
     * @return mixed
     * @throws Exception
     */
    public function putBall(int $index) {
        if ($index > Cache::get('containerSize')) {
            throw new Exception('index cannot be greater than ' . (Cache::get('containerSize')));
        }
        $this->container[$index]->ball[] = 0;
        if (count($this->container[$index]->ball) === $this->container[$index]->size) {
            $this->container[$index]->is_verified = true;
        }
        $this->saveContainers();

        return $this->container[$index];
    }

    /**
     * Find verified container and return it's index
     *
     * @param bool $ignoreError
     * @return false|int|string
     * @throws Exception
     */
    public function verifiedContainer(bool $ignoreError = false) {
        $container = Cache::get('container') ?? [];

        $verifiedIndex = array_search(true, array_column($container, 'is_verified'));

        if (!$ignoreError && $verifiedIndex > -1) {
            throw new Exception("Container " . $verifiedIndex . " is already full");
        }

        return array_search(true, array_column($container, 'is_verified'));
    }
}
