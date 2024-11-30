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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class CartController extends AbstractController
{
    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function addToCart($id, EntityManagerInterface $entityManager, ProductRepository $productRepository, OrderRepository $orderRepository, Security $security): JsonResponse {
        $user = $security->getUser();
    
        if (!$user) {
            return new JsonResponse(['danger' => 'User not authenticated'], 403);
        }
    
        $product = $productRepository->find($id);
        if (!$product) {
            return new JsonResponse(['danger' => 'Product not found'], 404);
        }
    
        $order = $orderRepository->findOneBy(['user' => $user, 'status' => OrderStatus::Pending]);
    
        if (!$order) {
            $order = new Order();
            $order->setUser($user);
            $order->setStatus(OrderStatus::Pending);
            $order->setCreatedAt(new \DateTime());
            $order->setReference('ORD-' . str_pad($orderRepository->count([]) + 1, 3, '0', STR_PAD_LEFT));
    
            $entityManager->persist($order);
            $entityManager->flush();
        }
    
        $existingOrderItem = $order->getOrderItem()->filter(function ($item) use ($product) {
            return $item->getProduct() === $product;
        })->first();
    
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
    
        return new JsonResponse(['success' => true, 'itemCount' => count($order->getOrderItem())]);
    }

    #[Route('/cart', name: 'cart_view')]
    public function viewCart(OrderRepository $orderRepository, Security $security, LocaleSwitcher $localeSwitcher, Request $request, EntityManagerInterface $entityManager)
    {
        $locale = $request->getSession()->get('_locale', 'en');
        $localeSwitcher->setLocale($locale);

        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $order = $orderRepository->findOneBy(['user' => $user, 'status' => 'Pending']);

        $itemCount = $order ? count($order->getOrderItem()) : 0;

        if ($order && $order->getOrderItem()->isEmpty()) {
            $order->setStatus(OrderStatus::Canceled);
            $entityManager->persist($order);
            $entityManager->flush();
            $order = null;
        }

        $total = 0;

        if ($order) {
            foreach ($order->getOrderItem() as $item) {
                $total += $item->getProductPrice() * $item->getQuantity();
            }
        }

        return $this->render('cart/view.html.twig', [
            'order' => $order,
            'total' => $total,
            'itemCount' => $itemCount,
        ]);
    }

    #[Route('/cart/cancel/{id}', name: 'order_cancel', methods: ['POST'])]
    public function cancelOrder(int $id, OrderRepository $orderRepository, EntityManagerInterface $entityManager): RedirectResponse {
        $order = $orderRepository->find($id);

        if (!$order) {
            $this->addFlash('danger', 'Order not found.');
            return $this->redirectToRoute('cart_view');
        }

        if ($order->getStatus()->toString() !== OrderStatus::Pending->toString()) {
            $this->addFlash('danger', 'Order cannot be canceled because it is not Pending.');
            return $this->redirectToRoute('cart_view');
        }

        $order->setStatus(OrderStatus::Canceled);
        $entityManager->flush();

        $this->addFlash('success', 'Your order has been successfully canceled.');
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
            $this->addFlash('danger', 'One or more products in you cart are not available.');
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

    #[Route('/order_item/delete/{id}', name: 'order_item_delete', methods: ['POST'])]
    public function deleteOrderItem(int $id, Request $request, EntityManagerInterface $entityManager): RedirectResponse {
        $orderItem = $entityManager->getRepository(OrderItem::class)->find($id);

        if (!$orderItem) {
            $this->addFlash('danger', 'Order item not found.');
            return $this->redirectToRoute('cart_view');
        }

        if (!$this->isCsrfTokenValid('delete_order_item' . $orderItem->getId(), $request->request->get('_token'))) {
            $this->addFlash('danger', 'Invalid token.');
            return $this->redirectToRoute('cart_view');
        }

        $entityManager->remove($orderItem);
        $entityManager->flush();

        $this->addFlash('success', 'Item deleted successfully.');

        return $this->redirectToRoute('cart_view');
    }

    #[Route('/cart/item-count', name: 'cart_item_count', methods: ['GET'])]
    public function getCartItemCount(EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $this->getUser();
        $order = $entityManager->getRepository(Order::class)->findOneBy([
            'user' => $user,
            'status' => OrderStatus::Pending
        ]);

        if (!$order) {
            return new JsonResponse(['count' => 0]);
        }

        $itemCount = count($order->getOrderItem());

        return new JsonResponse(['count' => $itemCount]);
    }

    #[Route('/cart/update/{id}', name: 'cart_update', methods: ['POST'])]
    public function updateCartItem($id, Request $request, EntityManagerInterface $entityManager, OrderItemRepository $orderItemRepository): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $newQuantity = $data['quantity'] ?? null;

        if (!$newQuantity || $newQuantity < 1) {
            return new JsonResponse(['success' => false, 'danger' => 'Invalid quantity'], 400);
        }

        $orderItem = $orderItemRepository->find($id);

        if (!$orderItem) {
            return new JsonResponse(['success' => false, 'danger' => 'Order item not found'], 404);
        }

        if ($newQuantity > $orderItem->getProduct()->getStock()) {
            return new JsonResponse(['success' => false, 'danger' => 'Quantity exceeds available stock'], 400);
        }

        $orderItem->setQuantity($newQuantity);
        $entityManager->flush();

        return new JsonResponse(['success' => true]);
    }
}
