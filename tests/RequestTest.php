<?php
/**
 * Created by PhpStorm.
 * User: larsvonqualen
 * Date: 19/12/2015
 * Time: 11.31
 */

class RequestTests extends PHPUnit_Framework_TestCase {
    public function testThatGetMethodReturnsTheCorrectMethod() {
        $s = $this->getMockServerVar();
        $h = $this->getMockHeaders();

        $s["REQUEST_METHOD"] = "GET";

        $req = new Lux\Request($s, $h);

        $this->assertEquals("get", $req->getMethod());
    }

    private function getMockServerVar() {
        return array(
            "REQUEST_METHOD" => "",
            "REQUEST_URI" => "",
            "QUERY_STRING" => ""
        );
    }

    private function getMockHeaders() {
        return array(
            "Content-Type" => ""
        );
    }
}