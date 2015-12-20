<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.29
 */

namespace Lux;

use Lux\Exceptions\NotFoundException;

/**
 * Class Handler
 * @package Lux
 */
class Handler
{
    /**
     * @var array
     */
    private $handlers = array(
        "get"       => array(),
        "post"      => array(),
        "put"       => array(),
        "delete"    => array(),
        "patch"     => array()
    );

    /**
     * @param string $method
     * @param string $urlPattern
     * @param callable $handler
     * @param array $middleware
     */
    public function register(\string $method, \string $urlPattern, callable $handler, $middleware = array()) {
        $m = strtolower($method);
        $key = empty(rtrim($urlPattern, "/")) ? "/" : rtrim($urlPattern, "/");

        $this->handlers[$m][$key] = array(
            "middleware" => $middleware,
            "handler" => $handler
        );
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     * @throws NotFoundException
     */
    public function handle(Request &$req, Response &$res)
    {
        $urlParams = $this->getUrlParameters($req->getUri());
        $urlParamsCount = count($urlParams);
        $handler = null;
        $methodGroup = $this->handlers[$req->getMethod()];

        if (count($methodGroup) == 0) {
            throw new NotFoundException("Unable to find any handlers.");
        }

        if (empty($urlParams)) {
            if (!isset($methodGroup["/"])) {
                throw new NotFoundException("Unable to find a '{$req->getMethod()}' root handler.");
            } else {
                $handler = $methodGroup["/"];
            }
        } else {
            foreach ($methodGroup as $key => $value) {
                $keyParams = array();

                preg_match_all("/\{([\w+]+)\}/", $key, $keyParams);

                if (count($keyParams[0]) != $urlParamsCount) continue;

                for ($i = 0; $i < count($urlParams); $i++) {
                    $req->setParam($keyParams[1][$i], urldecode($urlParams[$i]));
                }

                $handler = $value;
                break;
            }
        }

        if (!is_array($handler)) {
            throw new NotFoundException("Unable to find matching handler.");
        }

        foreach ($handler["middleware"] as $middleware) {
            /**
             * @var $middleware IMiddleware
             */
            $middleware->handle($req, $res);
        }

        if (!is_callable($handler["handler"])) {
            throw new NotFoundException("Handler is malformed.");
        }

        return $handler["handler"]($req, $res);
    }

    /**
     * @param string $url
     * @return array|string
     */
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