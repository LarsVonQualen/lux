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
 * Class JsonBodyParser
 * @package Lux\Middleware
 */
class JsonBodyParser implements IMiddleware
{
    /**
     * @var string
     */
    private $_input = null;

    /**
     * @param string $input
     */
    public function Input(\string $input) {
        $this->_input = $input;
    }

    /**
     * @param Request $req
     * @param Response $res
     */
    public function handle(Request &$req, Response &$res)
    {
        $contentType = $req->getHeader("Content-Type");

        if ($contentType != null && is_string($contentType) && $contentType == "application/json") {
            $json = $this->_input ?? file_get_contents('php://input');
            $jsonAsArray = json_decode($json, true);

            if ($jsonAsArray == null) return;

            $req->setParam("body", $jsonAsArray);
        }
    }
}