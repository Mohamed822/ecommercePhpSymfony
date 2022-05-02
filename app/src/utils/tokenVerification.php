<?php

namespace App\utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Request;

Class tokenVerification {


  private $key = "JWTSECRET";
  public function extractToken(Request $request):string{
    $authorizationHeader = $request->headers->get('Authorization');
    return substr($authorizationHeader, 7);
  }

  public function verifyUserToken($request):bool
    {
      $token = $this->extractToken($request);
      try {
          JWT::decode($token, new Key($this->key, 'HS256'));
          return true;
      } catch (\Throwable $th) {
        return false;
      }
    }
  public function getUserEmail($request):string
    {
      $token = $this->extractToken($request);
      $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
      return $decoded->iss;
    }
  
}
