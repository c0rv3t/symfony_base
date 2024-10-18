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
        $category1->setDescription("Suppléments");
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setDescription("Autres");
        $manager->persist($category2);

        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE . "_1", $category1);
        $this->addReference(self::CATEGORY_REFERENCE . "_2", $category2);
    }
}
