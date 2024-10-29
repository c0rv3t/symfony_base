<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/product/list.html.twig', name: 'product_list')]
    public function list(ProductRepository $product, Request $request, LocaleSwitcher $localeSwitcher): Response
    {
        $products = $product->findAllProducts();
        if($request->getSession()->has('_locale')) {
            $lang = $request->getSession()->get('_locale');
        } else {
            $lang = "en";
        }
        $localeSwitcher->setLocale($lang);

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }
}
