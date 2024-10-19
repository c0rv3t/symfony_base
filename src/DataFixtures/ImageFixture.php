<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixture extends Fixture
{
    public const IMAGE_REFERENCE = "Image";
    public function load(ObjectManager $manager): void
    {
        $image1 = new Image();
        $image1->setUrl("/img/Protein.webp");
        $manager->persist($image1);

        $image2 = new Image();
        $image2->setUrl("/img/M&Ms.png");
        $manager->persist($image2);

        $image3 = new Image();
        $image3->setUrl("/img/Seringue.jpg");
        $manager->persist($image3);

        $manager->flush();

        $this->addReference(self::IMAGE_REFERENCE . "_1", $image1);
        $this->addReference(self::IMAGE_REFERENCE . "_2", $image2);
        $this->addReference(self::IMAGE_REFERENCE . "_3", $image3);
    }
}
