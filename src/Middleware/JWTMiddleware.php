<?php

namespace app\Middleware;

use \Firebase\JWT\JWT;


class JWTMiddleware
{
    private $key = 'rahasia';

    function __invoke($request, $response, $next)
    {
        $jwt = $request->getHeader('authorization')[0];

        try {
            $decode = JWT::decode($jwt, $this->key, array('HS256'));

            return $next($request, $response);

        } catch (\Exception $e) {
            return $response->withJson([
                'success' => false,
                'message' => 'Token failed!'
            ], 401);
        }
    }
}
