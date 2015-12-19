<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 20.09
 */

namespace Owlie\Middleware;

use Owlie\Application;
use Owlie\IMiddleware;
use Owlie\Request;
use Owlie\Response;
use \Firebase\JWT\JWT;

class JwtParser implements IMiddleware {
    public function Handle(Request &$req, Response &$res)
    {
        $a = $req->getHeader("Authorization");

        if ($a != null && is_string($a)) {
            $split = explode(" ", $a);

            if (strtolower($split[0]) == "bearer") {
                $jwt = JWT::decode($split[1], Application::get("JWT_SECRET"), Application::get("JWT_ALGORITHMS"));

                $req->setParam("jwt", $jwt);
            }
        }
    }
}