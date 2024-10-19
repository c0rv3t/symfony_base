<?php

namespace App\DataFixtures;

use App\Entity\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderItemFixture extends Fixture
{
    public const ORDERITEM_REFERENCE = "OrderItem";
    public function load(ObjectManager $manager): void
    {
        $orderItem1 = new OrderItem();
        $orderItem1->setQuantity(6);
        $orderItem1->setProductPrice(10.00);
        $manager->persist($orderItem1);

        $manager->flush();

        $this->addReference(self::ORDERITEM_REFERENCE . "_1", $orderItem1);
    }
}
