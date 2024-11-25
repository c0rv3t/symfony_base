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

        $address5 = new Address();
        $address5->setStreet("123 Wonderland Avenue");
        $address5->setPostalCode("75000");
        $address5->setCity("Paris");
        $address5->setCountry("France");
        $manager->persist($address5);

        $address6 = new Address();
        $address6->setStreet("42 Infinite Loop");
        $address6->setPostalCode("69000");
        $address6->setCity("Lyon");
        $address6->setCountry("France");
        $manager->persist($address6);

        $address7 = new Address();
        $address7->setStreet("789 Elm Street");
        $address7->setPostalCode("13000");
        $address7->setCity("Marseille");
        $address7->setCountry("France");
        $manager->persist($address7);

        $address8 = new Address();
        $address8->setStreet("Diagon Alley 1");
        $address8->setPostalCode("60000");
        $address8->setCity("London");
        $address8->setCountry("UK");
        $manager->persist($address8);

        $address9 = new Address();
        $address9->setStreet("Privet Drive 4");
        $address9->setPostalCode("60001");
        $address9->setCity("Little Whinging");
        $address9->setCountry("UK");
        $manager->persist($address9);

        $address10 = new Address();
        $address10->setStreet("Hogsmeade Station");
        $address10->setPostalCode("60002");
        $address10->setCity("Hogsmeade");
        $address10->setCountry("UK");
        $manager->persist($address10);

        $address11 = new Address();
        $address11->setStreet("Grimmauld Place 12");
        $address11->setPostalCode("60003");
        $address11->setCity("London");
        $address11->setCountry("UK");
        $manager->persist($address11);

        $address12 = new Address();
        $address12->setStreet("Forbidden Forest");
        $address12->setPostalCode("60004");
        $address12->setCity("Hogwarts");
        $address12->setCountry("UK");
        $manager->persist($address12);

        $address13 = new Address();
        $address13->setStreet("The Burrow");
        $address13->setPostalCode("60005");
        $address13->setCity("Ottery St Catchpole");
        $address13->setCountry("UK");
        $manager->persist($address13);

        $address14 = new Address();
        $address14->setStreet("Leaky Cauldron 7");
        $address14->setPostalCode("60006");
        $address14->setCity("London");
        $address14->setCountry("UK");
        $manager->persist($address14);

        $address15 = new Address();
        $address15->setStreet("Godric's Hollow 12");
        $address15->setPostalCode("60007");
        $address15->setCity("Godric's Hollow");
        $address15->setCountry("UK");
        $manager->persist($address15);

        $address16 = new Address();
        $address16->setStreet("Shell Cottage");
        $address16->setPostalCode("60008");
        $address16->setCity("Tinworth");
        $address16->setCountry("UK");
        $manager->persist($address16);

        $address17 = new Address();
        $address17->setStreet("Azkaban 1");
        $address17->setPostalCode("60009");
        $address17->setCity("North Sea");
        $address17->setCountry("UK");
        $manager->persist($address17);

        $address18 = new Address();
        $address18->setStreet("Malfoy Manor");
        $address18->setPostalCode("60010");
        $address18->setCity("Wiltshire");
        $address18->setCountry("UK");
        $manager->persist($address18);

        $address19 = new Address();
        $address19->setStreet("Hogsmeade Village 23");
        $address19->setPostalCode("60011");
        $address19->setCity("Hogsmeade");
        $address19->setCountry("UK");
        $manager->persist($address19);

        $manager->flush();

        $this->addReference(self::ADDRESS_REFERENCE . "_1", $address1);
        $this->addReference(self::ADDRESS_REFERENCE . "_2", $address2);
        $this->addReference(self::ADDRESS_REFERENCE . "_3", $address3);
        $this->addReference(self::ADDRESS_REFERENCE . "_4", $address4);
        $this->addReference(self::ADDRESS_REFERENCE . "_5", $address5);
        $this->addReference(self::ADDRESS_REFERENCE . "_6", $address6);
        $this->addReference(self::ADDRESS_REFERENCE . "_7", $address7);
        $this->addReference(self::ADDRESS_REFERENCE . "_8", $address8);
        $this->addReference(self::ADDRESS_REFERENCE . "_9", $address9);
        $this->addReference(self::ADDRESS_REFERENCE . "_10", $address10);
        $this->addReference(self::ADDRESS_REFERENCE . "_11", $address11);
        $this->addReference(self::ADDRESS_REFERENCE . "_12", $address12);
        $this->addReference(self::ADDRESS_REFERENCE . "_13", $address13);
        $this->addReference(self::ADDRESS_REFERENCE . "_14", $address14);
        $this->addReference(self::ADDRESS_REFERENCE . "_15", $address15);
        $this->addReference(self::ADDRESS_REFERENCE . "_16", $address16);
        $this->addReference(self::ADDRESS_REFERENCE . "_17", $address17);
        $this->addReference(self::ADDRESS_REFERENCE . "_18", $address18);
        $this->addReference(self::ADDRESS_REFERENCE . "_19", $address19);
    }
}
