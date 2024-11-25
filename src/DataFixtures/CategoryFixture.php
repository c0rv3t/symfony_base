<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public const CATEGORY_REFERENCE = "Category";
    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setDescription("Supplements");
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setDescription("Sports equipment");
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setDescription("Valuables");
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setDescription("Clothes");
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setDescription("Shoes");
        $manager->persist($category5);

        $category6 = new Category();
        $category6->setDescription("Other");
        $manager->persist($category6);

        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE . "_1", $category1);
        $this->addReference(self::CATEGORY_REFERENCE . "_2", $category2);
        $this->addReference(self::CATEGORY_REFERENCE . "_3", $category3);
        $this->addReference(self::CATEGORY_REFERENCE . "_4", $category4);
        $this->addReference(self::CATEGORY_REFERENCE . "_5", $category5);
        $this->addReference(self::CATEGORY_REFERENCE . "_6", $category6);
    }
}
