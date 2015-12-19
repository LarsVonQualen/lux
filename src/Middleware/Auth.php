<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 20.21
 */

namespace Lux\Middleware;

use Lux\Exceptions\UnauthorizedException;
use Lux\IMiddleware;
use Lux\Request;
use Lux\Response;

class Auth implements IMiddleware {
    public function Handle(Request &$req, Response &$res)
    {
        //throw new UnauthorizedException();
    }
}