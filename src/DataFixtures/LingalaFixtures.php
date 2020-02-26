<?php

namespace App\DataFixtures;

use App\Entity\Lingala;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class LingalaFixtures
 */
class LingalaFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $lingala = new Lingala();
            $lingala->setWord(sprintf('mot lingala - %d', $i))
                ->setDescription(sprintf('description lingala - %d', $i))
                ->setExemple(sprintf('exemple lingala - %d', $i))
                ->setUrl(sprintf('url lingala  - %d', $i))
                ->setType(sprintf('type lingala - %d', $i))
                ->setLanguage('French')
                ->setStatus(true)
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $manager->persist($lingala);
            $manager->flush();
        }
    }
}
