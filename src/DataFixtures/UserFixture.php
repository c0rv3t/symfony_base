<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    public const USER_REFERENCE = "User";
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail("thomas.ducret2@etu.univ-lorraine.fr");
        $user1->setFirstName("Thomas");
        $user1->setLastName("Ducret");
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setPassword("ThomasPassword??");
        $user1->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_1"));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("CJ@hotmail.com");
        $user2->setFirstName("Carl");
        $user2->setLastName("Johnson");
        $user2->setRoles(roles: ["ROLE_USER"]);
        $user2->setPassword("!IStoppedThatTrain");
        $user2->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_3"));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail("YaquaMan@souloceau.com");
        $user3->setFirstName("Aquaman");
        $user3->setLastName("Curry");
        $user3->setRoles(["ROLE_USER"]);
        $user3->setPassword("Y'aQuoiMan?");
        $user3->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_4"));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail("bobMarley@gmail.com");
        $user4->setFirstName("Bob");
        $user4->setLastName("Marley");
        $user4->setRoles(["ROLE_USER"]);
        $user4->setPassword("ChuPeteBro!");
        $user4->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_2"));
        $manager->persist($user4);

        $user5 = new User();
        $user5->setEmail("arthur.ducret@email.com");
        $user5->setFirstName("Arthur");
        $user5->setLastName("Ducret");
        $user5->setRoles(["ROLE_ADMIN"]);
        $user5->setPassword("vraimentMonFrr1!");
        $user5->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_1"));
        $manager->persist($user5);

        $manager->flush();

        $this->addReference(self::USER_REFERENCE . "_1", $user1);
        $this->addReference(self::USER_REFERENCE . "_2", $user2);
        $this->addReference(self::USER_REFERENCE . "_3", $user3);
        $this->addReference(self::USER_REFERENCE . "_4", $user4);
        $this->addReference(self::USER_REFERENCE . "_5", $user5);
    }

    public function getDependencies(): array {
        return [
            AddressFixture::class
        ];
    }
}
