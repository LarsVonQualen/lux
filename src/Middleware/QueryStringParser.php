<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 19.10
 */

namespace Lux\Middleware;

use Lux\IMiddleware;
use Lux\Request;
use Lux\Response;

/**
 * Class QueryStringParser
 * @package Lux\Middleware
 */
class QueryStringParser implements IMiddleware {
    /**
     * @param Request $req
     * @param Response $res
     */
    public function Handle(Request &$req, Response &$res)
    {
        $q = $req->getQueryString();

        if ($q != null) {
            $split = explode("&", $q);

            foreach ($split as $pair) {
                $pairSplit = explode("=", $pair);

                $req->setParam(urldecode($pairSplit[0]), urldecode($pairSplit[1]));
            }
        }
    }
}