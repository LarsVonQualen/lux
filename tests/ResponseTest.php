<?php
use Owlie\Response;

/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 19/12/2015
 * Time: 12.01
 */

class ResponseTestes extends PHPUnit_Framework_TestCase {
    public function testThatJsonSetsCorrectContentType() {
        $res = new Response();

        $res->json(array());

        $this->assertEquals("application/json", $res->getHeader("Content-Type"));
    }

    public function testThatHtmlSetsCorrectContentType() {
        $res = new Response();

        $res->html("<h1>sup</h1>");

        $this->assertEquals("text/html", $res->getHeader("Content-Type"));
    }

    public function testThatStatusCodeIsSetProperly() {
        $res = new Response();

        $res->status(404);

        $this->assertEquals(404, $res->getStatus());
    }
}