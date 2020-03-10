<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\FrenchSango;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class FrenchSangoFixtures
 */
class FrenchSangoFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $sango   = $manager->getRepository('App:Sango')->find($i);
            $french  = $manager->getRepository('App:French')->find($i);
            $user    = $manager->getRepository('App:User')->findOneBy(['firstname' =>'admin']);

            $frenchLingala = new FrenchSango();

            $frenchLingala
                ->setFrench($french)
                ->setSango($sango)
                ->setUser($user)
                ->setUpdatedAt(new \DateTime('now'))
                ->setCreatedAt(new \DateTime('now'))
                ->setStatus(true)
                ->setLikes($i)
                ->setDescriptionSource(sprintf('description french source French %s', $i))
                ->setDescriptionTarget(sprintf('description french target Sango %s', $i))
            ;

            $manager->persist($frenchLingala);
            $manager->flush();
        }
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            FrenchFixtures::class,
            SangoFixtures::class,
            UserFixtures::class,
        );
    }
}
