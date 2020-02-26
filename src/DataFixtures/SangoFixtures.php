<?php

namespace App\DataFixtures;

use App\Entity\Sango;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class SangoFixtures
 */
class SangoFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $sango = new Sango();
            $sango->setWord(sprintf('mot sango - %d', $i))
                ->setDescription(sprintf('description sango - %d', $i))
                ->setExemple(sprintf('exemple sango - %d', $i))
                ->setUrl(sprintf('url sango  - %d', $i))
                ->setType(sprintf('type sango - %d', $i))
                ->setLanguage('French')
                ->setStatus(true)
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $manager->persist($sango);
            $manager->flush();
        }
    }
}
