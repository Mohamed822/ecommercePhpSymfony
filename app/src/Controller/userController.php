<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\utils\tokenVerification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class userSiteController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class userController extends AbstractController
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/register", name="register_user", methods={"POST"})
     */
    public function adduser(Request $request): JsonResponse
    {
      $data = json_decode($request->getContent(), true);
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $login = $data['login'];
        $password = $data['password'];
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if($user){
            return new JsonResponse(['error' => 'user already exists!'], Response::HTTP_CREATED);
        } else {            
        if (empty($firstName) || empty($lastName) || empty($email) || empty($login)||empty($password)) {
            return new JsonResponse(['error' => 'user attributes missing!'], Response::HTTP_CREATED);
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        } else {
            $this->userRepository->saveuser($firstName, $lastName, $email, $login,$password);        
            return new JsonResponse(['status' => 'user added!'], Response::HTTP_CREATED);
        }
    }
    }


    /**
     * @Route("/login", name="login_user", methods={"POST"})
     */
    public function login(Request $request): JsonResponse
    {
      $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];
        if(empty($email) || empty($password)){
            return new JsonResponse(['error' => 'user attributes missing!'], Response::HTTP_BAD_REQUEST);
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        } else {
            $user = $this->userRepository->findOneBy(['email' => $email]);
            if($user){
                $hashPass = $user->getPassword();
                $verify = password_verify($password,$hashPass);
                if($verify){
                $key = "JWTSECRET";
                $issuedAt = time();
                // jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
                $expirationTime = ($issuedAt + 60 * 60 * 24 * 60)*1000;
                $payload = array(
                    "iss" => $email,
                    "exp"=>$expirationTime
                );
                $jwt = JWT::encode($payload, $key, 'HS256');
                return new JsonResponse(['token' => $jwt], Response::HTTP_OK);
                } else {
                    return new JsonResponse(['error' => 'password incorrect!'], Response::HTTP_NOT_ACCEPTABLE);
                }
            } else {  
            return new JsonResponse(['status' => 'user not found!'], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    }


  public function supports(Request $request)
  {
      // look for header "Authorization: Bearer <token>"
      return $request->headers->has('Authorization')
          && 0 === strpos($request->headers->get('Authorization'), 'Bearer ');
  }
    /**
     * @Route("/user", name="get_one_user", methods={"GET"})
     */
    public function getOneuser(Request $request,tokenVerification $tokenService): JsonResponse
    {
            $valid =$tokenService->verifyUserToken($request);
            if(!$valid){
                return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
            } else {
                $email = $tokenService->getUserEmail($request);
            }
            $user = $this->userRepository->findOneBy(['email' => $email]);
            if(isset($user)){    
            $data = [
    
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'login' => $user->getLogin()
            ];
            return new JsonResponse($data, Response::HTTP_OK);
                 
        }
            return new JsonResponse(['error' => "not authorized"], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Route("/get-all", name="get_all_users", methods={"GET"})
     */
    public function getAllusers(): JsonResponse
    {
        $users = $this->userRepository->findAll();
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'login' => $user->getLogin()
              ];
        }

        return new JsonResponse(['users' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/update/{id}", name="update_user", methods={"PUT"})
     */
    public function updateuser($id, Request $request): JsonResponse
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        $this->userRepository->updateuser($user, $data);

        return new JsonResponse(['status' => 'user updated!']);
    }

    /**
     * @Route("/delete/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteuser($id): JsonResponse
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);

        $this->userRepository->removeuser($user);

        return new JsonResponse(['status' => 'user deleted']);
    }
}