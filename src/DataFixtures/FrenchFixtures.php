<?php

namespace App\DataFixtures;

use App\Entity\French;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class FrenchFixtures
 */
class FrenchFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $french = new French();
            $french->setWord(sprintf('mot - %d', $i))
                ->setDescription(sprintf('description - %d', $i))
                ->setExemple(sprintf('exemple - %d', $i))
                ->setUrl(sprintf('url - %d', $i))
                ->setType(sprintf('type - %d', $i))
                ->setLanguage('French')
                ->setStatus(true)
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $manager->persist($french);
            $manager->flush();
        }
    }
}
