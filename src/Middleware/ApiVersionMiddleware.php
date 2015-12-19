<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 19.35
 */

namespace Lux\Middleware;

use Lux\IMiddleware;
use Lux\Request;
use Lux\Response;

class ApiVersionMiddleware implements IMiddleware {
    public function Handle(Request &$req, Response &$res)
    {
        $res->setHeader("X-Api-Version", "0.1.0");
    }
}