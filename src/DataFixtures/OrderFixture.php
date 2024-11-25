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
        $order1->setCreatedAt(new \DateTime("2024/11/15"));
        $order1->setStatus(OrderStatus::Canceled);
        $order1->setUser($this->getReference(UserFixture::USER_REFERENCE . "_3"));
        $order1->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_1"));
        $manager->persist($order1);

        $order2 = new Order();
        $order2->setReference("ORD-002");
        $order2->setCreatedAt(new \DateTime("2023/12/17"));
        $order2->setStatus(OrderStatus::Shipped);
        $order2->setUser($this->getReference(UserFixture::USER_REFERENCE . "_5"));
        $order2->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_2"));
        $manager->persist($order2);

        $order3 = new Order();
        $order3->setReference("ORD-003");
        $order3->setCreatedAt(new \DateTime("2024/01/18"));
        $order3->setStatus(OrderStatus::Delivered);
        $order3->setUser($this->getReference(UserFixture::USER_REFERENCE . "_1"));
        $order3->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_4"));
        $order3->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_3"));
        $manager->persist($order3);

        $order4 = new Order();
        $order4->setReference("ORD-004");
        $order4->setCreatedAt(new \DateTime("2024/02/19"));
        $order4->setStatus(OrderStatus::Delivered);
        $order4->setUser($this->getReference(UserFixture::USER_REFERENCE . "_3"));
        $order4->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_5"));
        $manager->persist($order4);

        $order5 = new Order();
        $order5->setReference("ORD-005");
        $order5->setCreatedAt(new \DateTime("2024/03/20"));
        $order5->setStatus(OrderStatus::Canceled);
        $order5->setUser($this->getReference(UserFixture::USER_REFERENCE . "_4"));
        $order5->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_6"));
        $manager->persist($order5);

        $order6 = new Order();
        $order6->setReference("ORD-006");
        $order6->setCreatedAt(new \DateTime("2024/04/21"));
        $order6->setStatus(OrderStatus::Pending);
        $order6->setUser($this->getReference(UserFixture::USER_REFERENCE . "_1"));
        $order6->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_7"));
        $manager->persist($order6);

        $order7 = new Order();
        $order7->setReference("ORD-007");
        $order7->setCreatedAt(new \DateTime("2024/05/22"));
        $order7->setStatus(OrderStatus::Shipped);
        $order7->setUser($this->getReference(UserFixture::USER_REFERENCE . "_6"));
        $order7->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_8"));
        $manager->persist($order7);

        $order8 = new Order();
        $order8->setReference("ORD-008");
        $order8->setCreatedAt(new \DateTime("2024/06/23"));
        $order8->setStatus(OrderStatus::Delivered);
        $order8->setUser($this->getReference(UserFixture::USER_REFERENCE . "_7"));
        $order8->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_9"));
        $manager->persist($order8);

        $order9 = new Order();
        $order9->setReference("ORD-009");
        $order9->setCreatedAt(new \DateTime("2024/07/24"));
        $order9->setStatus(OrderStatus::Pending);
        $order9->setUser($this->getReference(UserFixture::USER_REFERENCE . "_8"));
        $order9->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_10"));
        $manager->persist($order9);

        $order10 = new Order();
        $order10->setReference("ORD-010");
        $order10->setCreatedAt(new \DateTime("2024/08/25"));
        $order10->setStatus(OrderStatus::Shipped);
        $order10->setUser($this->getReference(UserFixture::USER_REFERENCE . "_9"));
        $order10->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_11"));
        $manager->persist($order10);

        $order11 = new Order();
        $order11->setReference("ORD-011");
        $order11->setCreatedAt(new \DateTime("2024/09/26"));
        $order11->setStatus(OrderStatus::Canceled);
        $order11->setUser($this->getReference(UserFixture::USER_REFERENCE . "_10"));
        $order11->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_12"));
        $manager->persist($order11);

        $order12 = new Order();
        $order12->setReference("ORD-012");
        $order12->setCreatedAt(new \DateTime("2024/10/27"));
        $order12->setStatus(OrderStatus::Delivered);
        $order12->setUser($this->getReference(UserFixture::USER_REFERENCE . "_11"));
        $order12->addOrderItem($this->getReference(OrderItemFixture::ORDERITEM_REFERENCE . "_13"));
        $manager->persist($order12);

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
