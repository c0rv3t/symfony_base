<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const USER_REFERENCE = "User";
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user1, "ThomasPassword??");
        $user1->setEmail("thomas.ducret2@etu.univ-lorraine.fr");
        $user1->setFirstName("Thomas");
        $user1->setLastName("Ducret");
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setPassword($hashedPassword);
        $user1->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_1"));
        $manager->persist($user1);

        $user2 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user2, "!IStoppedThatTrain");
        $user2->setEmail("CJ@hotmail.com");
        $user2->setFirstName("Carl");
        $user2->setLastName("Johnson");
        $user2->setRoles(roles: ["ROLE_USER"]);
        $user2->setPassword($hashedPassword);
        $user2->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_3"));
        $manager->persist($user2);

        $user3 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user3, "Y'aQuoiMan?");
        $user3->setEmail("YaquaMan@souloceau.com");
        $user3->setFirstName("Aquaman");
        $user3->setLastName("Curry");
        $user3->setRoles(["ROLE_USER"]);
        $user3->setPassword($hashedPassword);
        $user3->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_4"));
        $manager->persist($user3);

        $user4 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user4, "ChuPeteBro!");
        $user4->setEmail("bobMarley@gmail.com");
        $user4->setFirstName("Bob");
        $user4->setLastName("Marley");
        $user4->setRoles(["ROLE_USER"]);
        $user4->setPassword($hashedPassword);
        $user4->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_2"));
        $manager->persist($user4);

        $user5 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user5, "leMdpDuChef0:");
        $user5->setEmail("arthur.maloron@mail.com");
        $user5->setFirstName("Arthur");
        $user5->setLastName("Maloron");
        $user5->setRoles(["ROLE_ADMIN"]);
        $user5->setPassword($hashedPassword);
        $user5->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_1"));
        $manager->persist($user5);

        $user6 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user6, "AnotherCoolPass6!");
        $user6->setEmail("jane.doe@email.com");
        $user6->setFirstName("Jane");
        $user6->setLastName("Doe");
        $user6->setRoles(["ROLE_USER"]);
        $user6->setPassword($hashedPassword);
        $user6->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_5"));
        $manager->persist($user6);

        $user7 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user7, "RandomPwd7$!");
        $user7->setEmail("john.smith@email.com");
        $user7->setFirstName("John");
        $user7->setLastName("Smith");
        $user7->setRoles(["ROLE_ADMIN"]);
        $user7->setPassword($hashedPassword);
        $user7->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_6"));
        $manager->persist($user7);

        $user8 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user8, "SafePassword8@!");
        $user8->setEmail("alice.wonderland@email.com");
        $user8->setFirstName("Alice");
        $user8->setLastName("Wonderland");
        $user8->setRoles(["ROLE_USER"]);
        $user8->setPassword($hashedPassword);
        $user8->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_7"));
        $manager->persist($user8);

        $user9 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user9, "UniquePass9!");
        $user9->setEmail("emma.watson@email.com");
        $user9->setFirstName("Emma");
        $user9->setLastName("Watson");
        $user9->setRoles(["ROLE_USER"]);
        $user9->setPassword($hashedPassword);
        $user9->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_8"));
        $manager->persist($user9);

        $user10 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user10, "SecureKey10$!");
        $user10->setEmail("daniel.radcliffe@email.com");
        $user10->setFirstName("Daniel");
        $user10->setLastName("Radcliffe");
        $user10->setRoles(["ROLE_USER"]);
        $user10->setPassword($hashedPassword);
        $user10->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_9"));
        $manager->persist($user10);

        $user11 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user11, "SuperSafe11@!");
        $user11->setEmail("rupert.grint@email.com");
        $user11->setFirstName("Rupert");
        $user11->setLastName("Grint");
        $user11->setRoles(["ROLE_USER"]);
        $user11->setPassword($hashedPassword);
        $user11->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_10"));
        $manager->persist($user11);

        $user12 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user12, "HogwartsMagic12!");
        $user12->setEmail("tom.felton@email.com");
        $user12->setFirstName("Tom");
        $user12->setLastName("Felton");
        $user12->setRoles(["ROLE_ADMIN"]);
        $user12->setPassword($hashedPassword);
        $user12->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_11"));
        $manager->persist($user12);

        $user13 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user13, "Gryffindor13!");
        $user13->setEmail("bonnie.wright@email.com");
        $user13->setFirstName("Bonnie");
        $user13->setLastName("Wright");
        $user13->setRoles(["ROLE_USER"]);
        $user13->setPassword($hashedPassword);
        $user13->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_12"));
        $manager->persist($user13);

        $user14 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user14, "Slytherin14@!");
        $user14->setEmail("matthew.lewis@email.com");
        $user14->setFirstName("Matthew");
        $user14->setLastName("Lewis");
        $user14->setRoles(["ROLE_USER"]);
        $user14->setPassword($hashedPassword);
        $user14->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_13"));
        $manager->persist($user14);

        $user15 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user15, "Lumos15!");
        $user15->setEmail("evanna.lynch@email.com");
        $user15->setFirstName("Evanna");
        $user15->setLastName("Lynch");
        $user15->setRoles(["ROLE_USER"]);
        $user15->setPassword($hashedPassword);
        $user15->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_14"));
        $manager->persist($user15);

        $user16 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user16, "Nox16!");
        $user16->setEmail("alfie.enoch@email.com");
        $user16->setFirstName("Alfie");
        $user16->setLastName("Enoch");
        $user16->setRoles(["ROLE_ADMIN"]);
        $user16->setPassword($hashedPassword);
        $user16->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_15"));
        $manager->persist($user16);

        $user17 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user17, "Patronus17$!");
        $user17->setEmail("katie.leung@email.com");
        $user17->setFirstName("Katie");
        $user17->setLastName("Leung");
        $user17->setRoles(["ROLE_USER"]);
        $user17->setPassword($hashedPassword);
        $user17->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_16"));
        $manager->persist($user17);

        $user18 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user18, "Alohomora18@!");
        $user18->setEmail("clémence.poésy@email.com");
        $user18->setFirstName("Clémence");
        $user18->setLastName("Poésy");
        $user18->setRoles(["ROLE_USER"]);
        $user18->setPassword($hashedPassword);
        $user18->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_17"));
        $manager->persist($user18);

        $user19 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user19, "Accio19$!");
        $user19->setEmail("stanislav.yanevski@email.com");
        $user19->setFirstName("Stanislav");
        $user19->setLastName("Yanevski");
        $user19->setRoles(["ROLE_USER"]);
        $user19->setPassword($hashedPassword);
        $user19->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_18"));
        $manager->persist($user19);

        $user20 = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user20, "ExpectoPatronum20!");
        $user20->setEmail("robbie.coltrane@email.com");
        $user20->setFirstName("Robbie");
        $user20->setLastName("Coltrane");
        $user20->setRoles(["ROLE_ADMIN"]);
        $user20->setPassword($hashedPassword);
        $user20->setAddress($this->getReference(AddressFixture::ADDRESS_REFERENCE . "_19"));
        $manager->persist($user20);

        $manager->flush();

        $this->addReference(self::USER_REFERENCE . "_1", $user1);
        $this->addReference(self::USER_REFERENCE . "_2", $user2);
        $this->addReference(self::USER_REFERENCE . "_3", $user3);
        $this->addReference(self::USER_REFERENCE . "_4", $user4);
        $this->addReference(self::USER_REFERENCE . "_5", $user5);
        $this->addReference(self::USER_REFERENCE . "_6", $user6);
        $this->addReference(self::USER_REFERENCE . "_7", $user7);
        $this->addReference(self::USER_REFERENCE . "_8", $user8);
        $this->addReference(self::USER_REFERENCE . "_9", $user9);
        $this->addReference(self::USER_REFERENCE . "_10", $user10);
        $this->addReference(self::USER_REFERENCE . "_11", $user11);
        $this->addReference(self::USER_REFERENCE . "_12", $user12);
        $this->addReference(self::USER_REFERENCE . "_13", $user13);
        $this->addReference(self::USER_REFERENCE . "_14", $user14);
        $this->addReference(self::USER_REFERENCE . "_15", $user15);
        $this->addReference(self::USER_REFERENCE . "_16", $user16);
        $this->addReference(self::USER_REFERENCE . "_17", $user17);
        $this->addReference(self::USER_REFERENCE . "_18", $user18);
        $this->addReference(self::USER_REFERENCE . "_19", $user19);
        $this->addReference(self::USER_REFERENCE . "_20", $user20);
    }

    public function getDependencies(): array {
        return [
            AddressFixture::class
        ];
    }
}
