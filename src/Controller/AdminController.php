<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class AdminController extends AbstractController
{
    #[Route('/admin/users', name: 'admin_users')]
    public function usersList(Request $request, PaginatorInterface $paginator, LocaleSwitcher $localeSwitcher, UserRepository $userRepository, Security $security, OrderRepository $orderRepository): Response
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

        $user = $security->getUser();
        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);
        $itemCount = $order ? count($order->getOrderItem()) : 0;

        return $this->render('admin/users.html.twig', [
            'pagination' => $pagination,
            'itemCount' => $itemCount,
        ]);
    }

    #[Route('/admin/orders', name: 'admin_orders')]
    public function ordersList(Request $request, LocaleSwitcher $localeSwitcher, OrderRepository $orderRepository, PaginatorInterface $paginator, Security $security): Response
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

        $user = $security->getUser();
        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);
        $itemCount = $order ? count($order->getOrderItem()) : 0;

        return $this->render('admin/orders.html.twig', [
            'pagination' => $pagination,
            'orders' => $orders,
            'itemCount' => $itemCount,
        ]);
    }

    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function dashboard(Request $request, LocaleSwitcher $localeSwitcher, CategoryRepository $categoryRepository, OrderRepository $orderRepository, ProductRepository $productRepository, PaginatorInterface $paginator, Security $security): Response
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $orders = $orderRepository->getOrderTotals();

        $productsByCategoryQuery = $categoryRepository->getProductsCountByCategory();

        $productsByCategory = $paginator->paginate(
            $productsByCategoryQuery,
            $request->query->getInt('page', 1),
            3
        );

        $latestOrders = $orderRepository->findLatestOrders(5);

        $monthlySales = $orderRepository->getMonthlySalesData();

        $totalProducts = $productRepository->count([]);
        $inStockCount = $productRepository->count(['status' => 'Available']);
        $outOfStockCount = $productRepository->count(['status' => 'Out']);
        $preOrderCount = $productRepository->count(['status' => 'Preorder']);

        $inStockPercentage = ($totalProducts > 0) ? ($inStockCount / $totalProducts) * 100 : 0;
        $outOfStockPercentage = ($totalProducts > 0) ? ($outOfStockCount / $totalProducts) * 100 : 0;
        $preOrderPercentage = ($totalProducts > 0) ? ($preOrderCount / $totalProducts) * 100 : 0;

        $user = $security->getUser();
        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);
        $itemCount = $order ? count($order->getOrderItem()) : 0;

        return $this->render('admin/dashboard.html.twig', [
            'productsByCategory' => $productsByCategory,
            'latestOrders' => $latestOrders,
            'monthlySales' => $monthlySales,
            'inStockPercentage' => $inStockPercentage,
            'preOrderPercentage' => $preOrderPercentage,
            'outOfStockPercentage' => $outOfStockPercentage,
            'orders' => $orders,
            'itemCount' => $itemCount,
        ]);
    }
}
