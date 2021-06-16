<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USERS = 50;

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $user = new User();
        $user->setEmail('bilbo@baggins.com');
        $user->setFirstname('Bilbo');
        $user->setLastname('Baggins');

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'baggins'
        ));

        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('frodo@baggins.com');
        $admin->setFirstname('Frodo');
        $admin->setLastname('Baggins');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'sauron'
        ));

        $manager->persist($admin);

        for ($i = 0; $i < self::USERS; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'toto'
            ));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
