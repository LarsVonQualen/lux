<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.22
 */

namespace Lux;

class Request {
    private $_method = "";
    private $_uri = "";
    private $_params = array();
    private $_headers = array();
    private $_queryString = null;

    public function __construct($serverVar = null, $headers = null)
    {
        $this->_headers = $headers ?? getallheaders();

        $s = $serverVar ?? $_SERVER;

        $this->_method = strtolower($s["REQUEST_METHOD"]);
        $this->_uri = $s["REQUEST_URI"];

        if (isset($s["QUERY_STRING"])) {
            $this->_queryString = $s["QUERY_STRING"];
        }
    }

    public function getMethod(): \string {
        return $this->_method;
    }

    public function getUri(): \string {
        return $this->_uri;
    }

    public function getParams(): array {
        return $this->_params;
    }

    public function setParam($key, $value) {
        $this->_params[$key] = $value;
    }

    public function getHeaders(): array {
        return $this->_headers;
    }

    public function getHeader(\string $name) {
        return $this->_headers[$name] ?? null;
    }

    public function getQueryString() {
        return $this->_queryString;
    }
}