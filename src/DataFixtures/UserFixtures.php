<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * Class UserFixtures
 */
class UserFixtures extends Fixture
{
    const ADMIN_USER_REFERENCE = 'admin-user';

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setEmail('admin@admin.fr')
            ->setFirstname('admin')
            ->setLastname('admin')
            ->setRoles([])
            ->setGender('masculin')
            ->setPassword('admin')
        ;

        $manager->persist($user);
        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference(self::ADMIN_USER_REFERENCE, $user);
    }
}
