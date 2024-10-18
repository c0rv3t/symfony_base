<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixture extends Fixture
{
    public const ADDRESS_REFERENCE = "Address";
    public function load(ObjectManager $manager): void
    {
        $address1 = new Address();
        $address1->setStreet("JeVPasLeakMonAdresse");
        $address1->setPostalCode("57000");
        $address1->setCity("Metz");
        $address1->setCountry("France");
        $manager->persist($address1);

        $address2 = new Address();
        $address2->setStreet("Rue dubedo");
        $address2->setPostalCode("97650");
        $address2->setCity("Petar");
        $address2->setCountry("France");
        $manager->persist($address2);

        $address3 = new Address();
        $address3->setStreet("Grove Street");
        $address3->setPostalCode("06426");
        $address3->setCity("Compton");
        $address3->setCountry("Etats-Unis");
        $manager->persist($address3);

        $address4 = new Address();
        $address4->setStreet("Avenue Detrident");
        $address4->setPostalCode("00042");
        $address4->setCity("Atlantis");
        $address4->setCountry("Royaume-Aquatique");
        $manager->persist($address4);

        $manager->flush();

        $this->addReference(self::ADDRESS_REFERENCE . "_1", $address1);
        $this->addReference(self::ADDRESS_REFERENCE . "_2", $address2);
        $this->addReference(self::ADDRESS_REFERENCE . "_3", $address3);
        $this->addReference(self::ADDRESS_REFERENCE . "_4", $address4);
    }
}
