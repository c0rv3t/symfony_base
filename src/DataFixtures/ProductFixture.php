<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\ProductStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_REFERENCE = "Product";
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName("Protéine Whey");
        $product1->setPrice(12.99);
        $product1->setDescription("Un classique, rien à dire de plus");
        $product1->setStock(24);
        $product1->setStatus(ProductStatus::Available);
        $product1->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product1->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_1"));
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName("Protéine M&M's");
        $product2->setPrice(4.99);
        $product2->setDescription("De la protéine pas cher pour les pauvres");
        $product2->setStock(25);
        $product2->setStatus(ProductStatus::Preorder);
        $product2->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product2->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_2"));
        $manager->persist($product2);
        
        $product3 = new Product();
        $product3->setName("Seringue usagée");
        $product3->setPrice(1280.00);
        $product3->setDescription("Seringue usagée de Ronnie Coleman datant de 1987");
        $product3->setStock(0);
        $product3->setStatus(ProductStatus::Out);
        $product3->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_3"));
        $product3->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_3"));
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setName("Kettlebell 16kg");
        $product4->setPrice(39.99);
        $product4->setDescription("Idéal pour le cross-training");
        $product4->setStock(10);
        $product4->setStatus(ProductStatus::Available);
        $product4->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_2"));
        $product4->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_4"));
        $manager->persist($product4);

        $product5 = new Product();
        $product5->setName("Barre Olympique");
        $product5->setPrice(199.99);
        $product5->setDescription("Une barre de 15Kg qui permet de faire des exercices tels que les squats, du développé couché etc");
        $product5->setStock(20);
        $product5->setStatus(ProductStatus::Available);
        $product5->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_2"));
        $product5->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_5"));
        $manager->persist($product5);

        $product6 = new Product();
        $product6->setName("Collier de musculation en or");
        $product6->setPrice(249.99);
        $product6->setDescription("Pour ceux qui aiment soulever avec style");
        $product6->setStock(3);
        $product6->setStatus(ProductStatus::Preorder);
        $product6->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_3"));
        $product6->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_6"));
        $manager->persist($product6);

        $product7 = new Product();
        $product7->setName("T-shirt compression 'I Lift Heavy'");
        $product7->setPrice(19.99);
        $product7->setDescription("Conçu pour les entraînements intensifs, ne comporte pas la personne posant avec le T-shirt");
        $product7->setStock(15);
        $product7->setStatus(ProductStatus::Available);
        $product7->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_4"));
        $product7->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_7"));
        $manager->persist($product7);

        $product8 = new Product();
        $product8->setName("Short d'entraînement");
        $product8->setPrice(14.99);
        $product8->setDescription("Short léger et respirant style Geox");
        $product8->setStock(20);
        $product8->setStatus(ProductStatus::Available);
        $product8->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_4"));
        $product8->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_8"));
        $manager->persist($product8);

        $product9 = new Product();
        $product9->setName("Chaussures de sport 'Abibas'");
        $product9->setPrice(79.99);
        $product9->setDescription("Chaussures ultra-légères pour la course");
        $product9->setStock(18);
        $product9->setStatus(ProductStatus::Available);
        $product9->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_5"));
        $product9->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_9"));
        $manager->persist($product9);

        $product10 = new Product();
        $product10->setName("Crocs mode sport");
        $product10->setPrice(9.99);
        $product10->setDescription("Un must pour les salles de sport surtout sous la douche");
        $product10->setStock(25);
        $product10->setStatus(ProductStatus::Available);
        $product10->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_5"));
        $product10->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_10"));
        $manager->persist($product10);

        $product11 = new Product();
        $product11->setName("Sac de sport waterproof");
        $product11->setPrice(29.99);
        $product11->setDescription("Gardez vos affaires au sec, même sous la pluie, parfait pour la calisthénie");
        $product11->setStock(12);
        $product11->setStatus(ProductStatus::Available);
        $product11->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_6"));
        $product11->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_11"));
        $manager->persist($product11);

        $product12 = new Product();
        $product12->setName("Bande élastique");
        $product12->setPrice(6.99);
        $product12->setDescription("Polyvalent pour étirements et renforcement musculaire");
        $product12->setStock(40);
        $product12->setStatus(ProductStatus::Available);
        $product12->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_2"));
        $product12->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_12"));
        $manager->persist($product12);

        $product13 = new Product();
        $product13->setName("Shaker avec compartiments");
        $product13->setPrice(7.99);
        $product13->setDescription("Pratique pour transporter vos compléments");
        $product13->setStock(22);
        $product13->setStatus(ProductStatus::Available);
        $product13->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product13->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_13"));
        $manager->persist($product13);

        $product14 = new Product();
        $product14->setName("Haltères réglables");
        $product14->setPrice(89.99);
        $product14->setDescription("Haltères tout-en-un avec réglage facile");
        $product14->setStock(8);
        $product14->setStatus(ProductStatus::Available);
        $product14->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_2"));
        $product14->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_14"));
        $manager->persist($product14);

        $product15 = new Product();
        $product15->setName("Short de muscu 'Too Buff to Bluff'");
        $product15->setPrice(22.99);
        $product15->setDescription("Idéal pour les leg days (soit tout les 3 ans)");
        $product15->setStock(10);
        $product15->setStatus(ProductStatus::Preorder);
        $product15->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_4"));
        $product15->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_15"));
        $manager->persist($product15);

        $product16 = new Product();
        $product16->setName("Pack de 6 Oeufs de la ferme de Luc");
        $product16->setPrice(3.99);
        $product16->setDescription("Des oeufs bien Bio et protéinés, bien frais et parfait pour vos gainz");
        $product16->setStock(250);
        $product16->setStatus(ProductStatus::Available);
        $product16->setCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE . "_1"));
        $product16->setImage($this->getReference(ImageFixture::IMAGE_REFERENCE . "_16"));
        $manager->persist($product16);

        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE . "_1", $product1);
        $this->addReference(self::PRODUCT_REFERENCE . "_2", $product2);
        $this->addReference(self::PRODUCT_REFERENCE . "_3", $product3);
        $this->addReference(self::PRODUCT_REFERENCE . "_4", $product4);
        $this->addReference(self::PRODUCT_REFERENCE . "_5", $product5);
        $this->addReference(self::PRODUCT_REFERENCE . "_6", $product6);
        $this->addReference(self::PRODUCT_REFERENCE . "_7", $product7);
        $this->addReference(self::PRODUCT_REFERENCE . "_8", $product8);
        $this->addReference(self::PRODUCT_REFERENCE . "_9", $product9);
        $this->addReference(self::PRODUCT_REFERENCE . "_10", $product10);
        $this->addReference(self::PRODUCT_REFERENCE . "_11", $product11);
        $this->addReference(self::PRODUCT_REFERENCE . "_12", $product12);
        $this->addReference(self::PRODUCT_REFERENCE . "_13", $product13);
        $this->addReference(self::PRODUCT_REFERENCE . "_14", $product14);
        $this->addReference(self::PRODUCT_REFERENCE . "_15", $product15);
        $this->addReference(self::PRODUCT_REFERENCE . "_16", $product16);
    }
    public function getDependencies(): array {
        return [
            CategoryFixture::class,
            ImageFixture::class
        ];
    }
}
