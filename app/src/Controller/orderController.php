<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\tokenVerification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * Class orderSiteController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class orderController extends AbstractController
{
    private $orderRepository;
    private $productRepository;
    private $userRepository; 
    public function __construct(ProductRepository $productRepository,UserRepository $userRepository,OrderRepository $orderRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }


    public function formatOrder(Order $order){
      $products = $order->getProducts();
      $allProducts=[];
    foreach ($products as $product) {
      $oneProduct = $this->productRepository->findOneBy(['id'=>$product]);
      $allProducts[] = [
          'id' => $oneProduct->getId(),
          'name' => $oneProduct->getName(),
          'description' => $oneProduct->getDescription(),
          'photo' => $oneProduct->getPhoto(),
          'price' => $oneProduct->getPrice()
        ];
      }
      return [
        'id'=>$order->getId(),
        "totalPrice"=>$order->getTotalPrice(),
        "creationDate"=>$order->getCreationDate(),
        "products"=>$allProducts
      ];
    }

    /**
     * @Route("/order/{id}", name="get_one_order", methods={"GET"})
     */
    public function getOneorder(tokenVerification $tokenService,Request $request,$id): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
          $order = $this->orderRepository->findOneBy(['id' => $id]);
          if(is_null($order)){
            return new JsonResponse(['error' => "Not order found." ], Response::HTTP_NOT_ACCEPTABLE);
          }
          $orderUserId = $order->getUserId();
          if($userId === $orderUserId){
            if(is_null($order)){
              return new JsonResponse(['error' => "Not order found." ], Response::HTTP_NOT_ACCEPTABLE);
          } else { 
            $order= $this->formatOrder($order);
            return new JsonResponse(['order' => $order], Response::HTTP_OK); 
          }
          } else {
            return new JsonResponse(['error' => "this order does not belong to you "+$user->getFirstname()], Response::HTTP_UNAUTHORIZED);
          }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
    }



    /**
     * @Route("/orders", name="get_all_orders", methods={"GET"})
     */
    public function getAllorders(tokenVerification $tokenService,Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
            $orders = $this->orderRepository->findAll();
            $data = [];
            foreach ($orders as $order) {
              if($userId===$order->getUserId()){
                $data[] = $this->formatOrder($order);
              }
            }
            return new JsonResponse(['orders' => $data], Response::HTTP_OK);    
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
    }


    /**
     * @Route("/order/{id}", name="delete_order", methods={"DELETE"})
     */
    public function deleteProductFromorder(tokenVerification $tokenService,$id, Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
          $order = $this->orderRepository->findOneBy(['userId' => $userId]);
          if(is_null($order)){
            return new JsonResponse(['status' => 'order does not exists!'],Response::HTTP_NOT_ACCEPTABLE);
            } else {
                $this->orderRepository->remove($order);
                return new JsonResponse(['status' => 'order deleted!'], Response::HTTP_OK);    
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);

        }
    }

}