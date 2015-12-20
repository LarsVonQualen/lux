<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.22
 */

namespace Lux;

/**
 * Class Request
 * @package Lux
 */
class Request
{
    /**
     * @var string
     */
    private $method = "";
    /**
     * @var string
     */
    private $uri = "";
    /**
     * @var array
     */
    private $params = array();
    /**
     * @var array
     */
    private $headers = array();
    /**
     * @var string
     */
    private $queryString = null;

    /**
     * Request constructor.
     * @param array $serverVar
     * @param array $headers
     */
    public function __construct($serverVar = null, $headers = null)
    {
        $this->headers = $headers == null ? getallheaders() : $headers;

        $s = $serverVar == null ? $_SERVER : $serverVar;

        $this->method = strtolower($s["REQUEST_METHOD"]);
        $this->uri = $s["REQUEST_URI"];

        if (isset($s["QUERY_STRING"])) {
            $this->queryString = $s["QUERY_STRING"];
        }
    }

    /**
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getParam($key) {
        return isset($this->params[$key]) ? $this->params[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setParam($key, $value) {
        $this->params[$key] = $value;
    }

    /**
     * @return mixed
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getHeader($name) {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }

    /**
     * @return string
     */
    public function getQueryString() {
        return $this->queryString;
    }
}