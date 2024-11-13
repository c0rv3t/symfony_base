<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Enum\ProductStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('price', NumberType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('stock', NumberType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('status', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'Available' => ProductStatus::Available,
                    'Preorder' => ProductStatus::Preorder,
                    'Out of Stock' => ProductStatus::Out
                ],
                'choice_label' => function ($choice, $key, $value) {
                    return $key;
                },
            ])
            ->add('category', EntityType::class, [
                'attr' => ['class' => 'form-control'],
                'class' => Category::class,
                'choice_label' => 'description',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Product Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG)',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
