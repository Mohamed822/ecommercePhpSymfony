<?php

namespace App\Controller;

use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\tokenVerification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * Class cartSiteController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class cartController extends AbstractController
{
    private $CartRepository;
    private $productRepository;
    private $userRepository; 
    private $orderRepository;
    public function __construct(CartRepository $CartRepository,ProductRepository $productRepository,UserRepository $userRepository,OrderRepository $orderRepository)
    {
        $this->CartRepository = $CartRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @Route("/cart/{id}", name="add_product_to_cart", methods={"POST"})
     */
    public function addProductToCart(Request $request,tokenVerification $tokenService,$id): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
          $cart = $this->CartRepository->findOneBy(['userId' => $userId]);
          $product = $this->productRepository->findOneBy(['id'=>$id]);
          if(is_null($product)){
            return new JsonResponse(['error' => "Not product found." ], Response::HTTP_NOT_ACCEPTABLE);
          } else {
            if(is_null($cart)){
              $this->CartRepository->addCart($userId,$id);
                  return new JsonResponse(['status' => 'Cart created!'], Response::HTTP_CREATED);
                } else {
              $this->CartRepository->addProductToCart($cart,$id);
              return new JsonResponse(['status' => 'product added to cart!'], Response::HTTP_CREATED);
            }
          }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);

        }
      
    }


    /**
     * @Route("/cart/{id}", name="delete_product_from_cart", methods={"DELETE"})
     */
    public function deleteProductFromCart(tokenVerification $tokenService,$id, Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
          $cart = $this->CartRepository->findOneBy(['userId' => $userId]);
          if(is_null($cart)){
            return new JsonResponse(['status' => 'user does not have a cart yet!'],Response::HTTP_NOT_ACCEPTABLE);
            } else {
                $this->CartRepository->removeproductFromCart($cart,$id);
                return new JsonResponse(['status' => 'product deleted from cart!'], Response::HTTP_OK);    
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);

        }
    }

    /**
     * @Route("/cart", name="get_one_cart", methods={"GET"})
     */
    public function getOneCart(tokenVerification $tokenService,Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
          $cart = $this->CartRepository->findOneBy(['userId' => $userId]);
            if(is_null($cart)){
                return new JsonResponse(['error' => "Not cart found." ], Response::HTTP_NOT_ACCEPTABLE);
            } else {
              $products = $cart->getProducts();
              $data=[];
            foreach ($products as $product) {
              $oneProduct = $this->productRepository->findOneBy(['id'=>$product]);
              $data[] = [
                  'id' => $oneProduct->getId(),
                  'name' => $oneProduct->getName(),
                  'description' => $oneProduct->getDescription(),
                  'photo' => $oneProduct->getPhoto(),
                  'price' => $oneProduct->getPrice()
                ];
          }
                return new JsonResponse(['cart' => $data], Response::HTTP_OK); 
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
        
    }
    
    /**
     * @Route("/cart/validate", name="validate_cart", methods={"GET"})
     */
    public function validateCart(tokenVerification $tokenService,Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
          $email = $tokenService->getUserEmail($request);
          $user = $this->userRepository->findOneBy(['email' => $email]);
          $userId = $user->getId();
          $cart = $this->CartRepository->findOneBy(['userId' => $userId]);
            if(is_null($cart)){
                return new JsonResponse(['error' => "Not cart found." ], Response::HTTP_NOT_ACCEPTABLE);
            } else {
              $products = $cart->getProducts();
              $data=[];
              $price=0;
            foreach ($products as $product) {
              $oneProduct = $this->productRepository->findOneBy(['id'=>$product]);
              $price += $oneProduct->getPrice();
              $data[] = [
                  'id' => $oneProduct->getId(),
                  'name' => $oneProduct->getName(),
                  'description' => $oneProduct->getDescription(),
                  'photo' => $oneProduct->getPhoto(),
                  'price' => $oneProduct->getPrice()
                ];
          }
              $this->orderRepository->validateCart($userId,$data,$price);
              return new JsonResponse(['success' => "cart validated!"], Response::HTTP_OK); 
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
        
    }

}