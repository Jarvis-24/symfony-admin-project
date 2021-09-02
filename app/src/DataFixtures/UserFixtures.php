<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $roles[] = 'ROLE_ADMIN';
        $user = new User();
        $user->setEmail('admin@nomail.com');

        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        $user->setRoles($roles);

        $manager->persist($user);
        $manager->flush();

        for ($x = 1; $x <= 5; $x++) {

            $email = 'user'.$x.'@mail.com';
            $user = new User();
            $user->setEmail($email);

            $password = $this->encoder->encodePassword($user, '123456');
            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

        }

    }
}
