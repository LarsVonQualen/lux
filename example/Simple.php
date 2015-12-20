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

$handler->Register("get", "/{firstName}/{lastName}", function (Request $req, Response $res) {
    $res->redirect("/Simple.php/{$req->getParam("firstName")} {$req->getParam("lastName")}");
});

$handler->Register("put", "/{id}", function (Request $req, Response $res) {
    return $res->json([
        "id" => $req->getParam("id"),
        "req_body" => $req->getParam("body")
    ]);
});

$handler->Register("delete", "/{id}", function (Request $req, Response $res) {
    $res->status(204);
});

$handler->Register("post", "/", function (Request $req, Response $res) {
    return $res->json($req->getParam("body"));
});

LuxApplication::AttachHandler($handler);