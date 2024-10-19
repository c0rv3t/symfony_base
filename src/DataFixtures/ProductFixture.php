<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\ProductStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName("Protéine Whey");
        $product1->setPrice(12.99);
        $product1->setDescription("Un classique");
        $product1->setStock(24);
        $product1->setStatus(ProductStatus::Disponible);
        $product1->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product1->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_1"));
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName("Prot M&M's");
        $product2->setPrice(6.99);
        $product2->setDescription("Prot de wish");
        $product2->setStock(12);
        $product2->setStatus(ProductStatus::Disponible);
        $product2->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product2->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_2"));
        $manager->persist($product2);
        
        $product3 = new Product();
        $product3->setName("Seringue usagée");
        $product3->setPrice(1280.00);
        $product3->setDescription("Seringue usagée de Ronnie Coleman datant de 1987");
        $product3->setStock(1);
        $product3->setStatus(ProductStatus::Disponible);
        $product3->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product3->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_3"));
        $manager->persist($product3);

        $manager->flush();
    }
    public function getDependencies(): array {
        return [
            CategoryFixture::class,
            ImageFixture::class
        ];
    }
}
