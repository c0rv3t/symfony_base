<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Enum\OrderStatus;
use App\Enum\ProductStatus;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class CartController extends AbstractController
{
    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function addToCart($id, Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository, OrderRepository $orderRepository, OrderItemRepository $orderItemRepository, Security $security, LocaleSwitcher $localeSwitcher): RedirectResponse
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $user = $security->getUser();

        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);

        if (!$order) {
            $order = new Order();
            $order->setUser($user);
            $order->setStatus(OrderStatus::Pending);
            $order->setCreatedAt(new \DateTime());
            $order->setReference('ORD-' . str_pad($orderRepository->count([]) + 1, 3, '0', STR_PAD_LEFT));

            $entityManager->persist($order);
            $entityManager->flush();
        }

        $existingOrderItem = $orderItemRepository->findOneBy(['anOrder' => $order, 'product' => $product]);

        if ($existingOrderItem) {
            $existingOrderItem->setQuantity($existingOrderItem->getQuantity() + 1);
        } else {
            $orderItem = new OrderItem();
            $orderItem->setAnOrder($order);
            $orderItem->setProduct($product);
            $orderItem->setQuantity(1);
            $orderItem->setProductPrice($product->getPrice());

            $entityManager->persist($orderItem);
        }

        $entityManager->flush();

        return $this->redirectToRoute('cart_view');
    }

    #[Route('/cart', name: 'cart_view')]
    public function viewCart(OrderRepository $orderRepository, Security $security, LocaleSwitcher $localeSwitcher, Request $request, EntityManagerInterface $entityManager)
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $user = $security->getUser();

        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);

        $total = 0;

        if (!$order) {
            $order = new Order();
            $order->setUser($user);
            $order->setStatus(OrderStatus::Pending);
            $order->setReference('ORD-' . str_pad($orderRepository->count([]) + 1, 3, '0', STR_PAD_LEFT));
            $order->setCreatedAt(new \DateTime());

            $entityManager->persist($order);
            $entityManager->flush();
        }

        foreach ($order->getOrderItem() as $item) {
            $total += $item->getProductPrice() * $item->getQuantity();
        }

        return $this->render('cart/view.html.twig', [
            'order' => $order,
            'total' => $total
        ]);
    }

    #[Route('/cart/cancel/{id}', name: 'order_cancel', methods: ['POST'])]
    public function cancelOrder(int $id, OrderRepository $orderRepository, EntityManagerInterface $entityManager): RedirectResponse {
        $order = $orderRepository->find($id);

        if (!$order) {
            $this->addFlash('error', 'Order not found.');
            return $this->redirectToRoute('cart_view');
        }
    
        if ($order->getStatus()->toString() !== OrderStatus::Pending->toString()) {
            $this->addFlash('error', 'Order cannot be canceled because it is not Pending.');
            return $this->redirectToRoute('cart_view');
        }
    
        $order->setStatus(OrderStatus::Canceled);
        $entityManager->flush();
    
        $this->addFlash('success', 'Order has been successfully canceled.');
        return $this->redirectToRoute('cart_view');
    }

    #[Route('/cart/pay', name: 'cart_pay', methods: ['POST'])]
    public function pay(Request $request, EntityManagerInterface $entityManager, Security $security): RedirectResponse {
        if (!$this->isCsrfTokenValid('cart_pay', $request->request->get('_token'))) {
            $this->addFlash('danger', 'Invalid token');
            return $this->redirectToRoute('cart_view');
        }

        $user = $security->getUser();
        $order = $entityManager->getRepository(Order::class)->findOneBy(['user' => $user, 'status' => OrderStatus::Pending,]);

        if (!$order) {
            $this->addFlash('danger', 'No pending orders found.');
            return $this->redirectToRoute('cart_view');
        }

        $allAvailable = true;
        $insufficientStock = false;

        foreach ($order->getOrderItem() as $orderItem) {
            $product = $orderItem->getProduct();
            $quantity = $orderItem->getQuantity();

            if ($product->getStatus() !== ProductStatus::Available) {
                $allAvailable = false;
                break;
            }

            if ($product->getStock() < $quantity) {
                $insufficientStock = true;
                break;
            }
        }

        if (!$allAvailable) {
            $this->addFlash('danger', 'One or more products are not available.');
            return $this->redirectToRoute('cart_view');
        }

        if ($insufficientStock) {
            $this->addFlash('danger', 'Insufficient stock for one or more products.');
            return $this->redirectToRoute('cart_view');
        }

        foreach ($order->getOrderItem() as $orderItem) {
            $product = $orderItem->getProduct();
            $quantity = $orderItem->getQuantity();

            $product->setStock($product->getStock() - $quantity);

            $product->checkStockStatus();

            $entityManager->persist($product);
        }

        $order->setStatus(OrderStatus::Shipped);
        $entityManager->persist($order);

        $entityManager->flush();

        $this->addFlash('success', 'Transaction successful!');

        return $this->redirectToRoute('cart_view');
    }
}
