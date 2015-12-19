<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 20.21
 */

namespace Owlie\Middleware;

use Owlie\Exceptions\UnauthorizedException;
use Owlie\IMiddleware;
use Owlie\Request;
use Owlie\Response;

class Auth implements IMiddleware {
    public function Handle(Request &$req, Response &$res)
    {
        //throw new UnauthorizedException();
    }
}