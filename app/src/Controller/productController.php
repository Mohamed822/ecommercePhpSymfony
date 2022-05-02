<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\tokenVerification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * Class productSiteController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class productController extends AbstractController
{
    private $ProductRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->ProductRepository = $productRepository;
    }

    /**
     * @Route("/product", name="add_product", methods={"POST"})
     */
    public function addProduct(Request $request,tokenVerification $tokenService): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
            $data = json_decode($request->getContent(), true);
            $name = $data['name'];
            $description = $data['description'];
            $photo = $data['photo'];
            $price = $data['price'];
            $product = $this->ProductRepository->findOneBy(['name' => $name]);
            if($product){
                return new JsonResponse(['error' => 'product already exists!'], Response::HTTP_NOT_ACCEPTABLE);
            } else {            
            if (empty($name) || empty($description) || empty($photo) || empty($price)) {
                return new JsonResponse(['error' => 'product attributes missing!'], Response::HTTP_BAD_REQUEST);
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            } else {
                $this->ProductRepository->saveproduct($name, $description, $photo, $price);        
                return new JsonResponse(['status' => 'product added!'], Response::HTTP_CREATED);
            }
        }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);

        }
      
    }



    /**
     * @Route("/products/{id}", name="get_one_product", methods={"GET"})
     */
    public function getOneProduct($id,tokenVerification $tokenService,Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
            $product = $this->ProductRepository->findOneBy(['id' => $id]);
            if(is_null($product)){
                return new JsonResponse(['error' => "Not product found." ], Response::HTTP_NOT_ACCEPTABLE);
            } else {
                $data = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'photo' => $product->getPhoto(),
                    'price' => $product->getPrice()
                ];
                return new JsonResponse(['products' => $data], Response::HTTP_OK); 
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
        
    }

    /**
     * @Route("/products", name="get_all_products", methods={"GET"})
     */
    public function getAllproducts(tokenVerification $tokenService,Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
            $products = $this->ProductRepository->findAll();
            $data = [];
            foreach ($products as $product) {
                $data[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'photo' => $product->getPhoto(),
                    'price' => $product->getPrice()
                  ];
            }
            return new JsonResponse(['products' => $data], Response::HTTP_OK);    
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @Route("/product/{id}", name="update_product", methods={"PUT"})
     */
    public function updateproduct(tokenVerification $tokenService,$id, Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
            $product = $this->ProductRepository->findOneBy(['id' => $id]);
            if(is_null($product)){
            return new JsonResponse(['status' => 'product not found!'],Response::HTTP_NOT_ACCEPTABLE);
            } else {
                $data = json_decode($request->getContent(), true);
                $this->ProductRepository->updateproduct($product, $data);
                return new JsonResponse(['status' => 'product updated!'], Response::HTTP_OK);    
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);

        }
    }

    /**
     * @Route("/product/{id}", name="delete_product", methods={"DELETE"})
     */
    public function deleteproduct(tokenVerification $tokenService,$id,Request $request): JsonResponse
    {
        $valid =$tokenService->verifyUserToken($request);
        if($valid){
            $product = $this->ProductRepository->findOneBy(['id' => $id]);
            if(is_null($product)){
                return new JsonResponse(['status' => 'product not found!'],Response::HTTP_NOT_ACCEPTABLE);
            } else {
                $this->ProductRepository->removeproduct($product);
                return new JsonResponse(['status' => 'product deleted'],Response::HTTP_OK);        
            }
        } else {
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
        }
    }
}