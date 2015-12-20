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
    private $_method = "";
    /**
     * @var string
     */
    private $_uri = "";
    /**
     * @var array
     */
    private $_params = array();
    /**
     * @var array
     */
    private $_headers = array();
    /**
     * @var string
     */
    private $_queryString = null;

    /**
     * Request constructor.
     * @param array $serverVar
     * @param array $headers
     */
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

    /**
     * @return string
     */
    public function getMethod(): \string {
        return $this->_method;
    }

    /**
     * @return string
     */
    public function getUri(): \string {
        return $this->_uri;
    }

    /**
     * @return mixed
     */
    public function getParams(): array {
        return $this->_params;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getParam($key) {
        return $this->_params[$key] ?? null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setParam($key, $value) {
        $this->_params[$key] = $value;
    }

    /**
     * @return mixed
     */
    public function getHeaders(): array {
        return $this->_headers;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getHeader(\string $name) {
        return $this->_headers[$name] ?? null;
    }

    /**
     * @return string
     */
    public function getQueryString() {
        return $this->_queryString;
    }
}