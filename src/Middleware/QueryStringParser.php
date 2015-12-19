<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 19.10
 */

namespace Owlie\Middleware;

use Owlie\IMiddleware;
use Owlie\Request;
use Owlie\Response;

class QueryStringParser implements IMiddleware {
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