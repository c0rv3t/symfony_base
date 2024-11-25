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
        $image1->setUrl("/img/product/Protein.webp");
        $manager->persist($image1);

        $image2 = new Image();
        $image2->setUrl("/img/product/M&Ms.png");
        $manager->persist($image2);

        $image3 = new Image();
        $image3->setUrl("/img/product/Seringue.jpg");
        $manager->persist($image3);

        $image4 = new Image();
        $image4->setUrl("/img/product/kettlebell.png");
        $manager->persist($image4);

        $image5 = new Image();
        $image5->setUrl("/img/product/barre-olympique.jpg");
        $manager->persist($image5);

        $image6 = new Image();
        $image6->setUrl("/img/product/collier-or.webp");
        $manager->persist($image6);

        $image7 = new Image();
        $image7->setUrl("/img/product/ILiftHeavy.jpg");
        $manager->persist($image7);

        $image8 = new Image();
        $image8->setUrl("/img/product/Short.webp");
        $manager->persist($image8);

        $image9 = new Image();
        $image9->setUrl("/img/product/Abibas.jpg");
        $manager->persist($image9);

        $image10 = new Image();
        $image10->setUrl("/img/product/crocs.avif");
        $manager->persist($image10);

        $image11 = new Image();
        $image11->setUrl("/img/product/waterproof-bag.png");
        $manager->persist($image11);

        $image12 = new Image();
        $image12->setUrl("/img/product/Elastique.jpg");
        $manager->persist($image12);

        $image13 = new Image();
        $image13->setUrl("/img/product/Shaker.jpg");
        $manager->persist($image13);

        $image14 = new Image();
        $image14->setUrl("/img/product/Halteres-reglables.png");
        $manager->persist($image14);

        $image15 = new Image();
        $image15->setUrl("/img/product/Short-de-muscu.png");
        $manager->persist($image15);

        $image16 = new Image();
        $image16->setUrl("/img/product/Oeufs.jpg");
        $manager->persist($image16);

        $manager->flush();

        $this->addReference(self::IMAGE_REFERENCE . "_1", $image1);
        $this->addReference(self::IMAGE_REFERENCE . "_2", $image2);
        $this->addReference(self::IMAGE_REFERENCE . "_3", $image3);
        $this->addReference(self::IMAGE_REFERENCE . "_4", $image4);
        $this->addReference(self::IMAGE_REFERENCE . "_5", $image5);
        $this->addReference(self::IMAGE_REFERENCE . "_6", $image6);
        $this->addReference(self::IMAGE_REFERENCE . "_7", $image7);
        $this->addReference(self::IMAGE_REFERENCE . "_8", $image8);
        $this->addReference(self::IMAGE_REFERENCE . "_9", $image9);
        $this->addReference(self::IMAGE_REFERENCE . "_10", $image10);
        $this->addReference(self::IMAGE_REFERENCE . "_11", $image11);
        $this->addReference(self::IMAGE_REFERENCE . "_12", $image12);
        $this->addReference(self::IMAGE_REFERENCE . "_13", $image13);
        $this->addReference(self::IMAGE_REFERENCE . "_14", $image14);
        $this->addReference(self::IMAGE_REFERENCE . "_15", $image15);
        $this->addReference(self::IMAGE_REFERENCE . "_16", $image16);
    }
}
