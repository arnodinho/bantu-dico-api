<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\FrenchLingala;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class FrenchLingalaFixtures.
 *
 * @codeCoverageIgnore
 */
class FrenchLingalaFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; ++$i) {
            $lingala = $manager->getRepository('App:Lingala')->find($i);
            $french = $manager->getRepository('App:French')->find($i);

            $user = $manager->getRepository('App:User')->findOneBy(['firstname' => 'admin']);

            $frenchLingala = new FrenchLingala();

            $frenchLingala
                ->setFrench($french)
                ->setLingala($lingala)
                ->setUser($user)
                ->setUpdatedAt(new \DateTime('now'))
                ->setCreatedAt(new \DateTime('now'))
                ->setStatus(true)
                ->setLikes($i)
                ->setDescriptionSource(sprintf('description french source French %s', $i))
                ->setDescriptionTarget(sprintf('description french target Lingala %s', $i))
            ;

            $manager->persist($frenchLingala);
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            LingalaFixtures::class,
            FrenchFixtures::class,
            UserFixtures::class,
        ];
    }
}
