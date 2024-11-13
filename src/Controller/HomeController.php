<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, LocaleSwitcher $localeSwitcher, ProductRepository $productRepository): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $totalProducts = $productRepository->count([]);
        $inStockCount = $productRepository->count(['status' => 'Available']);
        $outOfStockCount = $productRepository->count(['status' => 'Out']);
        $preOrderCount = $productRepository->count(['status' => 'Preorder']);

        $inStockPercentage = ($totalProducts > 0) ? ($inStockCount / $totalProducts) * 100 : 0;
        $outOfStockPercentage = ($totalProducts > 0) ? ($outOfStockCount / $totalProducts) * 100 : 0;
        $preOrderPercentage = ($totalProducts > 0) ? ($preOrderCount / $totalProducts) * 100 : 0;

        return $this->render('home.html.twig', [
            'inStockPercentage' => $inStockPercentage,
            'preOrderPercentage' => $preOrderPercentage,
            'outOfStockPercentage' => $outOfStockPercentage,
        ]);
    }
}
