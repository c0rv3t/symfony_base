<?php

namespace App\DataFixtures;

use App\Entity\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderItemFixture extends Fixture implements DependentFixtureInterface
{
    public const ORDERITEM_REFERENCE = "OrderItem";
    public function load(ObjectManager $manager): void
    {
        $orderItem1 = new OrderItem();
        $orderItem1->setQuantity(6);
        $orderItem1->setProductPrice(12.99);
        $orderItem1->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_1"));
        $manager->persist($orderItem1);

        $orderItem2 = new OrderItem();
        $orderItem2->setQuantity(1);
        $orderItem2->setProductPrice(1280);
        $orderItem2->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_3"));
        $manager->persist($orderItem2);

        $manager->flush();

        $this->addReference(self::ORDERITEM_REFERENCE . "_1", $orderItem1);
        $this->addReference(self::ORDERITEM_REFERENCE . "_2", $orderItem2);
    }
    public function getDependencies(): array {
        return [
            ProductFixture::class
        ];
    }
}
