<?php

use App\Repository\Tennis\ContainerRepository;
use Illuminate\Support\Facades\Cache;

class ContainerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @throws Exception
     */
    public function testVerifiedFull()
    {
        $containerRepository = new ContainerRepository();
        $containerSize = 3;
        $containerCount = 4;
        $containerRepository->initContainers($containerCount, $containerSize);
        $this->assertIsArray($containerRepository->container);

        for ($i = 0; $i < $containerSize; $i++) {
            $containerRepository->putBall(2);
        }

        $this->assertGreaterThan(0, $containerRepository->verifiedContainer(true));

        foreach ($containerRepository->container as $container) {
            if ($container->is_verified) {
                $this->assertCount(Cache::get('containerSize') ?? 0, $container->ball);
            } else {
                $this->assertLessThan(Cache::get('containerSize') ?? 0, count($container->ball));
            }
        }
    }
}
