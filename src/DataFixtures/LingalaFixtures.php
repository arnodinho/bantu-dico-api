<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Lingala;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class LingalaFixtures.
 *
 * @codeCoverageIgnore
 */
class LingalaFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; ++$i) {
            $lingala = new Lingala();
            $lingala->setWord(sprintf('mot lingala - %d', $i))
                ->setDescription(sprintf('description lingala - %d', $i))
                ->setExemple(sprintf('exemple lingala - %d', $i))
                ->setUrl(sprintf('url lingala  - %d', $i))
                ->setType(sprintf('type lingala - %d', $i))
                ->setLanguage('Lingala')
                ->setStatus(true)
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $manager->persist($lingala);
            $manager->flush();
        }
    }
}
