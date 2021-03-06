<?php

namespace App\Http\Controllers;

use Dingo\Api\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Dingo\Api\Routing\Helpers;

class AuthController extends Controller
{
    use Helpers;
    protected $auth;
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = $this->auth->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        return response()->json(compact('token'));
    }
    public function refresh(){
      $token = $this->auth->getToken();
      if(!$token){
          throw new BadRequestHtttpException('Token not provided');
      }
      try{
          $token = JWTAuth::refresh($token);
      }catch(TokenInvalidException $e){
          throw new AccessDeniedHttpException('The token is invalid');
      }
      return $this->response->withArray(['token'=>$token]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {

      $user = $this->auth()->user();
      return $user;
    }
}
