<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class AdminController extends AbstractController
{
    #[Route('/admin/users', name: 'admin_users')]
    public function usersList(Request $request, PaginatorInterface $paginator, LocaleSwitcher $localeSwitcher, UserRepository $userRepository): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $queryBuilder = $userRepository->createQueryBuilder('u')
        ->leftJoin('u.address', 'a')
        ->addSelect('a');

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/users.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/admin/orders', name: 'admin_orders')]
    public function ordersList(Request $request, LocaleSwitcher $localeSwitcher, OrderRepository $orderRepository, PaginatorInterface $paginator): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $orders = $orderRepository->getOrderTotals();

        $queryBuilder = $orderRepository->createQueryBuilder('o')
        ->leftJoin('o.orderItem', 'oi')
        ->orderBy('o.createdAt', 'DESC')
        ->addSelect('oi');

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/orders.html.twig', [
            'pagination' => $pagination,
            'orders' => $orders,
        ]);
    }

    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function dashboard(Request $request, LocaleSwitcher $localeSwitcher, CategoryRepository $categoryRepository, OrderRepository $orderRepository, ProductRepository $productRepository): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $orders = $orderRepository->getOrderTotals();

        $productsByCategory = $categoryRepository->getProductsCountByCategory();

        $latestOrders = $orderRepository->findLatestOrders(5);

        $monthlySales = $orderRepository->getMonthlySalesData();

        $totalProducts = $productRepository->count([]);
        $inStockCount = $productRepository->count(['status' => 'Available']);
        $outOfStockCount = $productRepository->count(['status' => 'Out']);
        $preOrderCount = $productRepository->count(['status' => 'Preorder']);

        $inStockPercentage = ($totalProducts > 0) ? ($inStockCount / $totalProducts) * 100 : 0;
        $outOfStockPercentage = ($totalProducts > 0) ? ($outOfStockCount / $totalProducts) * 100 : 0;
        $preOrderPercentage = ($totalProducts > 0) ? ($preOrderCount / $totalProducts) * 100 : 0;

        return $this->render('admin/dashboard.html.twig', [
            'productsByCategory' => $productsByCategory,
            'latestOrders' => $latestOrders,
            'monthlySales' => $monthlySales,
            'inStockPercentage' => $inStockPercentage,
            'preOrderPercentage' => $preOrderPercentage,
            'outOfStockPercentage' => $outOfStockPercentage,
            'orders' => $orders,
        ]);
    }
}
