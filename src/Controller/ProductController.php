<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class ProductController extends AbstractController
{
    #[Route('/product/list.html.twig', name: 'product_list')]
    public function list(ProductRepository $product, Request $request, LocaleSwitcher $localeSwitcher): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $products = $product->findAllProducts();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/add', name: 'product_add')]
    public function add(Request $request, LocaleSwitcher $localeSwitcher, EntityManagerInterface $entityManager)
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->checkStockStatus();

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('imageFile')->getData();
            
            if ($imageFile) {
                $imageName = $product->getName() . '.' . $imageFile->guessExtension();
                $imageDirectory = $this->getParameter('product_images_directory');
                $imageFile->move($imageDirectory, $imageName);

                $image = new Image();
                $image->setUrl('/assets/img/product/' . $imageName);
                $image->setProduct($product);

                $entityManager->persist($image);
                $product->setImage($image);
            }

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/edit/{id}', name: 'product_edit')]
    public function edit(Request $request, LocaleSwitcher $localeSwitcher, Product $product, EntityManagerInterface $entityManager)
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->checkStockStatus();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

    #[Route('/product/delete/{id}', name: 'product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager)
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_list');
    }
}
