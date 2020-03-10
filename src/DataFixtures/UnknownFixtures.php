<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Unknown;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class UnknownFixtures
 */
class UnknownFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $unknown = new Unknown();
            $unknown
                ->setWord(sprintf('unknown word %d', $i))
                ->setSource('french')
                ->setTarget('Lingala')
                ->setOrigin('app')
                ->setCreatedAt(new \DateTime('now'))
            ;

            $manager->persist($unknown);
            $manager->flush();
        }
    }
}
