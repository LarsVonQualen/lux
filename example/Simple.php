<?php
require("../vendor/autoload.php");

use Lux\Handler;
use Lux\LuxApplication;
use Lux\Request;
use Lux\Response;

$handler = new Handler();

$handler->Register("get", "/", function (Request $req, Response $res) {
    return $res->html("<h1>Hello world!</h1>");
});

$handler->Register("get", "/{yourName}", function (Request $req, Response $res) {
    return $res->json([
        "hello" => $req->getParam("yourName")
    ]);
});

LuxApplication::AttachHandler($handler);