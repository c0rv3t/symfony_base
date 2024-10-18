<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\ProductStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName("Protéine Whey");
        $product1->setPrice(12.99);
        $product1->setDescription("");
        $product1->setStock(24);
        $product1->setStatus(ProductStatus::Disponible);
        $product1->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product1->setOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_1"));
        $product1->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_1"));
        $manager->persist($product1);
        
        $product2 = new Product();
        $product2->setName("Seringue usagée");
        $product2->setPrice(1282.99);
        $product2->setDescription("Seringue usagée de Ronnie Coleman datant de 1987");
        $product2->setStock(1);
        $product2->setStatus(ProductStatus::Disponible);
        $product2->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product2->setOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_1"));
        $product2->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_1"));
        $manager->persist($product2);

        $manager->flush();
    }
}
