<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 18/12/2015
 * Time: 18.30
 */

namespace Owlie;

class Response {
    private $_headers = array();
    private $_status = 200;

    public function getHeaders(): array {
        return $this->_headers;
    }

    public function getHeader($key) {
        return $this->_headers[$key] ?? null;
    }

    public function getStatus(): int {
        return $this->_status;
    }

    public function setHeader(\string $key, \string $value) {
        $this->_headers[$key] = $value;
    }

    public function status(int $statusCode) {
        $this->_status = $statusCode;

        return $this;
    }

    public function json($object) {
        $this->setHeader("Content-Type", "application/json");

        return json_encode($object);
    }

    public function html($html) {
        $this->setHeader("Content-Type", "text/html");

        return $html;
    }

    public function send($object) {
        return $object;
    }
}