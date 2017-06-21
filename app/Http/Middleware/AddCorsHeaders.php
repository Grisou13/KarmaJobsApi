<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 01.06.2017
 * Time: 11:22
 */

namespace App\Http\Middleware;

use Closure;

class AddCorsHeaders
{
  public function handle($request, Closure $next)
  {
    /**
     * @var $response \Illuminate\Http\Response
     */
    $response = $next($request);

    // Perform action
    $response->withHeaders([
      "Access-Control-Allow-Headers"=>"Authorization, Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, X-ACCESS-TOKEN, X-access-token, x-access-token",
      "Access-Control-Allow-Origin"=>"*",
      "Access-Control-Request-Method"=>"GET, POST, PUT, PATCH, DELETE",
      "Access-Control-Request-Headers"=>"Authorization, Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, X-ACCESS-TOKEN, X-access-token, x-access-token",
      "Access-Control-Max-Age"=>0
    ]);
    return $response;
  }
}
