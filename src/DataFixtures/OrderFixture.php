<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Enum\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixture extends Fixture implements DependentFixtureInterface
{
    public const ORDER_REFERENCE = "Order";
    public function load(ObjectManager $manager): void
    {
        $order1 = new Order();
        $order1->setReference("ORD-001");
        $order1->setCreatedAt(new \DateTime("2024/10/14"));
        $order1->setStatus(OrderStatus::Preparation);
        $order1->setUser($this->getReference(UserFixture::USER_REFERENCE . "_1"));
        $order1->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_1"));
        $manager->persist($order1);

        $order2 = new Order();
        $order2->setReference("ORD-002");
        $order2->setCreatedAt(new \DateTime("2024/09/17"));
        $order2->setStatus(OrderStatus::Annulee);
        $order2->setUser($this->getReference(UserFixture::USER_REFERENCE . "_5"));
        $order2->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_1"));
        $manager->persist($order2);

        $order3 = new Order();
        $order3->setReference("ORD-003");
        $order3->setCreatedAt(new \DateTime("2024/08/28"));
        $order3->setStatus(OrderStatus::Preparation);
        $order3->setUser($this->getReference(UserFixture::USER_REFERENCE . "_3"));
        $order3->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_1"));
        $manager->persist($order3);

        $manager->flush();

        $this->addReference(self::ORDER_REFERENCE . "_1", $order1);
        $this->addReference(self::ORDER_REFERENCE . "_2", $order2);
        $this->addReference(self::ORDER_REFERENCE . "_3", $order3);
    }
    public function getDependencies(): array {
        return [
            UserFixture::class,
            OrderItemFixture::class
        ];
    }
}
