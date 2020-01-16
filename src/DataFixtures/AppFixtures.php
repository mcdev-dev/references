<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\UserCoordonnees;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) 
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $genres = ['m', 'f'];

        $adminRole = new Role;
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $admin = new User;
        $admin  ->setPrenom('Frédéric')
                ->setNom('Leclerc')
                ->setUsername('fredo18')
                ->setEmail('fredo_leclerc@orange.fr')
                ->setCivilite('m')
                ->setPassword($this->encoder->encodePassword($admin, '12345'))
                ->addUserRole($adminRole)
        ;
        $manager->persist($admin);

        $users = [];


        for($i = 0; $i < 10; $i++) 
        {
            $userCoordonnees = new UserCoordonnees;
            $genre = ['male', 'female'];
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';
            $picture .= ($genres == 'male' ? 'men/' : 'women/') . $pictureId;

            $userCoordonnees->setAvatar($picture)
                            //->setTelephone($faker->mobileNumber)
                            //->setPays($faker->country)
                            //->setVille($faker->cityName)
                            //->setCodePostal($faker->postcode)
                            //->setAdresse($faker->address)
            ;
            $users[] = $userCoordonnees;

            $manager->persist($userCoordonnees);
        }

        
        for($i = 0; $i < 10; $i++) 
        {
            $user = new User;
            $hash = $this->encoder->encodePassword($user, '12345');
            $genre = $faker->randomElement($genres);
            $userCoordonnees = $users[ mt_rand(0, count($users) - 1) ];

            $user   ->setNom($faker->lastname)
                    ->setPrenom($faker->firstname($genre))
                    ->setUsername($faker->username)
                    ->setEmail($faker->freeEmail)
                    ->setPassword($hash)
                    ->setCivilite($genre)
                    ->setUserCoordonnees($userCoordonnees)
                    ;
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
