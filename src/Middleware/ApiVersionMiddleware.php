<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 19.35
 */

namespace Owlie\Middleware;

use Owlie\IMiddleware;
use Owlie\Request;
use Owlie\Response;

class ApiVersionMiddleware implements IMiddleware {
    public function Handle(Request &$req, Response &$res)
    {
        $res->setHeader("X-Api-Version", "0.1.0");
    }
}