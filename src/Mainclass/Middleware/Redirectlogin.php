<?php

namespace Mainclass\Middleware;

use Mainclass\Models\Usuario;

Class Redirectlogin{
	public function __invoke($request, $response, $next){
    if($_SESSION['auth']){
      return $response->withHeader('Location', BASE_URL.'inicio' );
    }
    $response = $next($request, $response);

    return $response;
  }
}