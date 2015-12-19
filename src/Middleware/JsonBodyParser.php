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

class JsonBodyParser implements IMiddleware {
    private $_input = null;

    public function Input(\string $input) {
        $this->_input = $input;
    }

    public function Handle(Request &$req, Response &$res)
    {
        $contentType = $req->getHeader("Content-Type");

        if ($contentType != null && is_string($contentType) && $contentType == "application/json") {
            $json = $this->_input ?? file_get_contents('php://input');
            $jsonAsArray = json_decode($json, true);

            if ($jsonAsArray == null) return;

            foreach($jsonAsArray as $key => $value) {
                $req->setParam($key, $value);
            }
        }
    }
}