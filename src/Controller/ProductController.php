<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class ProductController extends AbstractController
{
    #[Route('/product/list', name: 'product_list')]
    public function list(ProductRepository $product, Request $request, LocaleSwitcher $localeSwitcher, OrderRepository $orderRepository, Security $security): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $query = $request->query->get('q', '');

        $products = $product->findAllProducts();

        $user = $security->getUser();

        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);

        $itemCount = $order ? count($order->getOrderItem()) : 0;

        return $this->render('product/list.html.twig', [
            'pagination' => $products,
            'searchQuery' => $query,
            'itemCount' => $itemCount,
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

            $this->addFlash('success', 'Produit ajouté avec succès !');

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

        $existingImage = $product->getImage();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->checkStockStatus();

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('imageFile')->getData();
        
            if ($imageFile) {
                $imageDirectory = $this->getParameter('kernel.project_dir') . '/public/assets/img/product/';
                $newImageName = $product->getName() . '.' . $imageFile->guessExtension();
                
                if ($existingImage && file_exists($imageDirectory . basename($existingImage->getUrl()))) {
                    unlink($imageDirectory . basename($existingImage->getUrl()));
                }

                $imageFile->move($imageDirectory, $newImageName);

                $image = $existingImage ?? new Image();
                $image->setUrl('/assets/img/product/' . $newImageName);
                $image->setProduct($product);

                $entityManager->persist($image);
                $product->setImage($image);
            }

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('info', 'Produit modifié avec succès !');

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
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $orderItems = $product->getOrderItems();
            
            if (!$orderItems->isEmpty()) {
                $this->addFlash('danger', "Ce produit ne peut pas être supprimé car il fait partie d'une commande.");
                return $this->redirectToRoute('product_list');
            }
            
            $entityManager->remove($product);
            $entityManager->flush();
    
            $this->addFlash('success', 'Produit supprimé avec succès !');
        } else {
            $this->addFlash('danger', 'Échec de la suppression du produit. Token CSRF invalide.');
        }

        return $this->redirectToRoute('product_list');
    }

    #[Route('/product/search', name: 'product_search', methods: ['GET'])]
    public function search(Request $request, ProductRepository $productRepository): JsonResponse
    {
        $query = $request->query->get('q', '');
        $products = $productRepository->searchByName($query);
    
        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
                'image' => $product->getImage() ? $product->getImage()->getUrl() : null,
            ];
        }
    
        return new JsonResponse($results);
    }
}
