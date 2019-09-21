<?php

namespace App\Tests\Functional;

use App\Entity\Grower;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GrowerSearchTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testfindByYearAndCropType()
    {
        $repo = $this->entityManager->getRepository(Grower::class);
        $growers = $repo->findByYearAndCropType(2019, 'corn');

        $this->assertSame('grower_2', $growers[0]->getName());
        $this->assertSame('grower_1', $growers[1]->getName());

        $growers = $repo->findByYearAndCropType(2019, 'soybeans');
        $this->assertSame('grower_2', $growers[0]->getName());
        $this->assertSame('grower_1', $growers[1]->getName());

        $growers = $repo->findByYearAndCropType(2018, 'soybeans');
        $this->assertSame('grower_3', $growers[0]->getName());

        $growers = $repo->findByYearAndCropType(2018, 'corn');
        $this->assertSame('grower_3', $growers[0]->getName());
        $this->assertSame('grower_1', $growers[1]->getName());
        $this->assertSame('grower_2', $growers[2]->getName());
    }

    protected function tearDown()
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}