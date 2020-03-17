<?php

namespace Mainclass\Middleware;

use Mainclass\Models\Usuario;

Class Authentication{
	public function __invoke($request, $response, $next){
        if($_SESSION['auth']!=true){
            $path = BASE_URL.$request->getUri()->getPath();

			return $response->withHeader('Location', BASE_URL."?m=".base64_encode('Debes iniciar sesión para acceder a este recurso' )."&redirect=".base64_encode($path) );
        }
    $response = $next($request, $response);
    return $response;
	}
}