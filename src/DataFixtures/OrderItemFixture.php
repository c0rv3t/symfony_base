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

        $orderItem3 = new OrderItem();
        $orderItem3->setQuantity(6);
        $orderItem3->setProductPrice(12.99);
        $orderItem3->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_1"));
        $manager->persist($orderItem3);

        $orderItem4 = new OrderItem();
        $orderItem4->setQuantity(100);
        $orderItem4->setProductPrice(3.99);
        $orderItem4->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_16"));
        $manager->persist($orderItem4);

        $orderItem5 = new OrderItem();
        $orderItem5->setQuantity(5);
        $orderItem5->setProductPrice(25.99);
        $orderItem5->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_5"));
        $manager->persist($orderItem5);

        $orderItem6 = new OrderItem();
        $orderItem6->setQuantity(4);
        $orderItem6->setProductPrice(6.99);
        $orderItem6->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_6"));
        $manager->persist($orderItem6);

        $orderItem7 = new OrderItem();
        $orderItem7->setQuantity(2);
        $orderItem7->setProductPrice(22.99);
        $orderItem7->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_7"));
        $manager->persist($orderItem7);

        $orderItem8 = new OrderItem();
        $orderItem8->setQuantity(1);
        $orderItem8->setProductPrice(30.99);
        $orderItem8->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_8"));
        $manager->persist($orderItem8);

        $orderItem9 = new OrderItem();
        $orderItem9->setQuantity(3);
        $orderItem9->setProductPrice(9.99);
        $orderItem9->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_9"));
        $manager->persist($orderItem9);

        $orderItem10 = new OrderItem();
        $orderItem10->setQuantity(2);
        $orderItem10->setProductPrice(14.99);
        $orderItem10->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_10"));
        $manager->persist($orderItem10);

        $orderItem11 = new OrderItem();
        $orderItem11->setQuantity(7);
        $orderItem11->setProductPrice(5.99);
        $orderItem11->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_11"));
        $manager->persist($orderItem11);

        $orderItem12 = new OrderItem();
        $orderItem12->setQuantity(1);
        $orderItem12->setProductPrice(18.99);
        $orderItem12->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_12"));
        $manager->persist($orderItem12);

        $orderItem13 = new OrderItem();
        $orderItem13->setQuantity(10);
        $orderItem13->setProductPrice(4.99);
        $orderItem13->setProduct($this->getReference(ProductFixture::PRODUCT_REFERENCE . "_13"));
        $manager->persist($orderItem13);

        $manager->flush();

        $this->addReference(self::ORDERITEM_REFERENCE . "_1", $orderItem1);
        $this->addReference(self::ORDERITEM_REFERENCE . "_2", $orderItem2);
        $this->addReference(self::ORDERITEM_REFERENCE . "_3", $orderItem3);
        $this->addReference(self::ORDERITEM_REFERENCE . "_4", $orderItem4);
        $this->addReference(self::ORDERITEM_REFERENCE . "_5", $orderItem5);
        $this->addReference(self::ORDERITEM_REFERENCE . "_6", $orderItem6);
        $this->addReference(self::ORDERITEM_REFERENCE . "_7", $orderItem7);
        $this->addReference(self::ORDERITEM_REFERENCE . "_8", $orderItem8);
        $this->addReference(self::ORDERITEM_REFERENCE . "_9", $orderItem9);
        $this->addReference(self::ORDERITEM_REFERENCE . "_10", $orderItem10);
        $this->addReference(self::ORDERITEM_REFERENCE . "_11", $orderItem11);
        $this->addReference(self::ORDERITEM_REFERENCE . "_12", $orderItem12);
        $this->addReference(self::ORDERITEM_REFERENCE . "_13", $orderItem13);
    }
    public function getDependencies(): array {
        return [
            ProductFixture::class
        ];
    }
}
