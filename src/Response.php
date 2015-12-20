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
    private $headers = array();
    /**
     * @var int
     */
    private $status = 200;

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @param $key
     * @return string|null
     */
    public function getHeader($key) {
        return isset($this->headers[$key]) ? $this->headers[$key] : null;
    }

    /**
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function status($statusCode) {
        $this->status = $statusCode;

        return $this;
    }

    /**
     * @param $object
     * @return string
     */
    public function json($object) {
        return $this->contentType("application/json")->send(json_encode($object));
    }

    /**
     * @param string $html
     * @return string
     */
    public function html($html) {
        return $this->contentType("text/html")->send($html);
    }

    /**
     * @param string $type
     * @return Response
     */
    public function contentType($type) {
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

    /**
     * @param string $url
     * @return Response
     */
    public function redirect($url) {
        $this->setHeader("location", $url);

        return $this->status(302);
    }

    /**
     * @param string $url
     * @return Response
     */
    public function redirectPermanent($url) {
        $this->setHeader("location", $url);

        return $this->status(301);
    }
}