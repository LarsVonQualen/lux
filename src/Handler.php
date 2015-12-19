<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.29
 */

namespace Lux;

use Lux\Exceptions\NotFoundException;

class Handler {
    private $_handlers = array(
        "get"       => array(),
        "post"      => array(),
        "put"       => array(),
        "delete"    => array(),
        "patch"     => array()
    );

    public function __construct()
    {
    }

    public function Register(\string $method, \string $urlPattern, callable $handler, $middleware = array()) {
        $m = strtolower($method);

        $this->_handlers[$m][rtrim($urlPattern, "/")] = array(
            "middleware" => $middleware,
            "handler" => $handler
        );
    }

    public function Handle(Request &$req, Response &$res)
    {
        $urlParams = $this->getUrlParameters($req->getUri());
        $urlParamsCount = count($urlParams);
        $handler = null;
        $methodGroup = $this->_handlers[$req->getMethod()];

        if (count($methodGroup) == 0) {
            throw new NotFoundException();
        }

        if (empty($urlParams)) {
            if (!isset($methodGroup["/"])) {
                throw new NotFoundException();
            } else {
                $handler = $methodGroup["/"];
            }
        } else {
            foreach ($methodGroup as $key => $value) {
                $keyParams = array();

                preg_match_all("/\{([\w+]+)\}/", $key, $keyParams);

                if (count($keyParams[0]) != $urlParamsCount) continue;

                for ($i = 0; $i < count($urlParams); $i++) {
                    $req->setParam($keyParams[1][$i], $urlParams[$i]);
                }

                $handler = $value;
                break;
            }
        }

        if (!is_array($handler)) {
            throw new NotFoundException();
        }

        foreach ($handler["middleware"] as $middleware) {
            /**
             * @var $middleware IMiddleware
             */
            $middleware->Handle($req, $res);
        }

        if (!is_callable($handler["handler"])) {
            throw new NotFoundException();
        }

        return $handler["handler"]($req, $res);
    }

    private function getUrlParameters(\string $url) {
        $matches = array();

        preg_match("/(.*)\/(.\w+\.\w+)\/(.*)/i", rtrim($url, "/"), $matches);

        if (count($matches) == 4) {
            return explode("/", $matches[3]);
        } else {
            return "";
        }
    }
}