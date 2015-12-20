<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.30
 */

namespace Lux;

/**
 * Class Response
 * @package Lux
 */
class Response
{
    /**
     * @var array
     */
    private $_headers = array();
    /**
     * @var int
     */
    private $_status = 200;

    /**
     * @return array
     */
    public function getHeaders(): array {
        return $this->_headers;
    }

    /**
     * @param $key
     * @return string|null
     */
    public function getHeader($key) {
        return $this->_headers[$key] ?? null;
    }

    /**
     * @return int
     */
    public function getStatus(): \int {
        return $this->_status;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setHeader(\string $key, \string $value) {
        $this->_headers[$key] = $value;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function status(int $statusCode): Response {
        $this->_status = $statusCode;

        return $this;
    }

    /**
     * @param $object
     * @return string
     */
    public function json($object): \string {
        return $this->contentType("application/json")->send(json_encode($object));
    }

    /**
     * @param string $html
     * @return string
     */
    public function html(\string $html): \string {
        return $this->contentType("text/html")->send($html);
    }

    /**
     * @param string $type
     * @return Response
     */
    public function contentType(\string $type): Response {
        $this->setHeader("Content-Type", $type);

        return $this;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function send($object) {
        return $object;
    }

    public function redirect(\string $url) {
        $this->setHeader("location", $url);

        return $this->status(302);
    }

    public function redirectPermanent(\string $url) {
        $this->setHeader("location", $url);

        return $this->status(301);
    }
}